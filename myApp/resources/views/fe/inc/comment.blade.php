
<style>
    .star-rating .bi-star-fill {
        font-size: 2rem; /* Kích thước ngôi sao lớn hơn */

        color: #ffc107;
        cursor: pointer;
    }
    .star-rating .bi-star-fill.inactive {
        color: #ddd;
    }
</style>
<div class="container mt-5">
    <h1 class="text-center">Đánh Giá Sản Phẩm</h1>
    @error('g-recaptcha-response')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reviews.store') }}" method="POST" class="mt-4">
        @csrf
        <!-- Đánh giá sao -->
        <div class="mb-3">
            <label for="rating" class="form-label">Đánh giá sao</label>
            <div class="star-rating d-flex">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star-fill inactive" data-value="{{ $i }}"></i>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating" value="0">
        </div>

        @if(Auth::check())
            <!-- Hiển thị thông tin nếu đã đăng nhập -->
            <div class="mb-3">
                <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>
        @else
            <!-- Hiển thị form nếu là ẩn danh -->
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        @endif

{{--        <!-- Nhận xét -->--}}
        <div class="mb-3">
            <label for="comment" class="form-label">Nhận xét</label>
            <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
        </div>
{{--        <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>--}}
        <div class="g-recaptcha" data-sitekey="6LeCx4EqAAAAEdkbDxZv8oyCGgqkefz6Y1zQhHl"></div>

        <br/>
        @if($errors->has('g-recaptcha-response'))
            <span class="invalid-feedback" style="display:block">
	<strong>{{$errors->first('g-recaptcha-response')}}</strong>
</span>
        @endif

        <!-- Nút Gửi -->
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Gửi Đánh Giá</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // JavaScript để xử lý đánh giá sao
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star-rating .bi-star-fill');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;

                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.remove('inactive');
                    } else {
                        s.classList.add('inactive');
                    }
                });
            });
        });
    });
</script>
{{--<script src="https://www.google.com/recaptcha/api.js" async defer></script>--}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

{{--<script src="{{asset('style/js/fe.js')}}"></script>--}}
