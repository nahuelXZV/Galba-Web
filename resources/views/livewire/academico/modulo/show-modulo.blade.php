<div class="mt-5">
    <nav class="flex justify-between py-3 mb-5">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-500 dark:hover:text-gray-600">
                    <x-iconos.home />
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <a href="{{ route('modulo.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Modulos</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-500">Ver</span>
                </div>
            </li>
        </ol>
        <div>
            <a href="{{ route('modulo.list') }}"
                class="inline-flex items-center justify-center h-9 px-4 text-sm font-medium text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Volver
            </a>
            <a href="{{ route('modulo.edit', $modulo->id) }}"
                class="inline-flex items-center justify-center h-9 px-4 text-sm font-medium text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Editar
            </a>
            <a href="{{ route('modulo.nota', $modulo->id) }}"
                class="inline-flex items-center justify-center h-9 px-4 text-sm font-medium text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Ingresar notas
            </a>
        </div>
    </nav>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <p class="text-xl font-semibold text-gray-900 dark:text-white">Datos del modulo</p>
        </div>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($dataModulo as $data)
                <div class="relative z-0 w-full mb-6 group">
                    <input readonly value="{{ $data['value'] }}"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transdiv -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ $data['label'] }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <p class="text-xl font-semibold text-gray-900 dark:text-white">Listado de estudiantes</p>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Telefono
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Correo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Detalles
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nota
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $estudiante['nombre'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $estudiante['telefono'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $estudiante['correo'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $estudiante['detalles'] ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $estudiante['nota'] ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
