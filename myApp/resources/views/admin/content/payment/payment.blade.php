<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tạo Link thanh toán</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body style="display: flex">
<div style="padding-top: 10px; display: flex; flex-direction: column">
    <div
        style="border: 2px solid blue; border-radius: 10px; overflow: hidden"
    >
        <div id="content-container" style="padding: 10px">
            <p><strong>Tên sản phẩm:</strong> Mì tôm Hảo Hảo ly</p>
            <p><strong>Giá tiền:</strong> 2000 VNĐ</p>
            <p><strong>Số lượng:</strong> 1</p>
        </div>
        <div id="button-container">
            <button
                type="submit"
                id="create-payment-link-btn"
                style="
              width: 100%;
              background-color: blue;
              color: white;
              border: none;
              padding: 10px;
              font-size: 15px;
            "
            >
                Tạo Link thanh toán
            </button>
        </div>
    </div>
    <div id="embeded-payment-container" style="height: 350px"></div>
</div>
</body>
<script src="https://cdn.payos.vn/payos-checkout/v1/stable/payos-initialize.js"></script>
<script>
    /* eslint-disable no-undef */
    const buttonContainer = document.getElementById("button-container");
    const contentContainer = document.getElementById("content-container");
    let isOpen = false;
    let config = {
        RETURN_URL: window.location.origin,
        ELEMENT_ID: "embeded-payment-container",
        CHECKOUT_URL: "",
        embedded: true,
        onSuccess: (event) => {
            contentContainer.innerHTML = `
        <div style="padding-top: 20px; padding-bottom:20px">
            Thanh toan thanh cong
        </div>
    `;
            buttonContainer.innerHTML = `
        <button
            type="submit"
            id="create-payment-link-btn"
            style="
            width: 100%;
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            font-size: 15px;
            "
        >
            Quay lại trang thanh toán
        </button>
    `;
        },
    };
    buttonContainer.addEventListener("click", async (event) => {
        if (isOpen) {
            const { exit } = PayOSCheckout.usePayOS(config);
            exit();
            contentContainer.innerHTML = `
        <p><strong>Tên sản phẩm:</strong> Mì tôm Hảo Hảo ly</p>
        <p><strong>Giá tiền:</strong> 2000 VNĐ</p>
        <p><strong>Số lượng:</strong> 1</p>
    `;
        } else {
            const checkoutUrl = await getPaymentLink();
            config = {
                ...config,
                CHECKOUT_URL: checkoutUrl,
            };
            const { open } = PayOSCheckout.usePayOS(config);
            open();
        }
        isOpen = !isOpen;
        changeButton();
    });

    document.getElementById("create-payment-link-btn").addEventListener("click", function() {
        // Make an AJAX request to your Laravel backend to generate the payment link
        fetch('/admin/create-payment-link', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.checkoutUrl) {
                    window.location.href = data.checkoutUrl;
                } else {
                    console.error("Error creating payment link");
                }
            })
            .catch(error => console.error('Error:', error));
    });


    const getPaymentLink = async () => {
        const response = await fetch(
            "http://localhost:3030/create-embedded-payment-link",
            {
                method: "POST",
            }
        );
        if (!response.ok) {
            console.log("server doesn't response!");
        }
        const result = await response.json();
        return result.checkoutUrl;
    };

    const changeButton = () => {
        if (isOpen) {
            buttonContainer.innerHTML = `
        <button
            type="submit"
            id="create-payment-link-btn"
            style="
            width: 100%;
            background-color: gray;
            color: white;
            border: none;
            padding: 10px;
            font-size: 15px;
            "
        >
            Đóng link thanh toán
        </button>
      `;
        } else {
            buttonContainer.innerHTML = `
        <button
            type="submit"
            id="create-payment-link-btn"
            style="
                width: 100%;
                background-color: blue;
                color: white;
                border: none;
                padding: 10px;
                font-size: 15px;
            "
            >
            Tạo Link thanh toán
        </button>
    `;
        }
    };

</script>

</html>