<button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
    class="relative inline-flex items-center text-base font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
    type="button">
    <x-iconos.cart />
    <span
        class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
        5
    </span>
</button>
<div id="dropdownNotification"
    class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
    aria-labelledby="dropdownNotificationButton">
    <div
        class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
        Productos
    </div>
    <div class="divide-y divide-gray-100 dark:divide-gray-700">
        <div class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 ">
            <div class="flex-shrink-0">
                <img class="rounded-full w-11 h-11" src="{{ asset('img/cover.jpg') }}" alt="Jese image">
            </div>
            <div class="w-full ps-3">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">Fierro
                    <span class="float-right">
                        <span class="font-semibold text-gray-900 dark:text-white">S/ 10.00</span>
                    </span>
                </div>
                <div class="text-xs text-blue-600 dark:text-blue-500">5 Unidades</div>
            </div>
        </div>

    </div>
    <a href="#"
        class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
        <div class="inline-flex items-center ">
            <x-iconos.pedido />
            Completar Compra
        </div>
    </a>
</div>
