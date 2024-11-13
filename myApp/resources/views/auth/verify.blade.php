<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Xác thực 2 bước để truy cập vào người dùng.') }}
    </div>

    <form method="POST" action="{{ route('xac-minh.store') }}">
        @csrf

        <div>
            <x-input-label for="code" :value="__('Nhập mã Code bạn nhận được')" />

            <x-text-input id="code" class="block mt-1 w-full"
                            type="text"
                            name="code"
                            required  />

            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Xác nhận') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
