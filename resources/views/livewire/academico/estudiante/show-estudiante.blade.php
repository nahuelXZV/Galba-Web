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
                    <a href="{{ route('estudiante.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Estudiantes</a>
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
            <a href="{{ route('estudiante.list') }}"
                class="inline-flex items-center justify-center h-9 px-4 text-sm font-medium text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Volver
            </a>
            <a href="{{ route('estudiante.edit', $estudiante->id) }}"
                class="inline-flex items-center justify-center h-9 px-4 text-sm font-medium text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Editar
            </a>
            @if ($estudiante->estado === 'Abandono')
                <button onclick="confirm('¿Está seguro?') || event.stopImmediatePropagation()"
                    wire:click="reincorporar()"
                    class="inline-flex items-center justify-center h-9 px-4 text-sm font-medium text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                    Reincorporar
                </button>
            @else
                <button onclick="confirm('¿Está seguro?') || event.stopImmediatePropagation()" wire:click="abandono()"
                    class="inline-flex items-center justify-center h-9 px-4 text-sm font-medium text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                    Abandono
                </button>
            @endif

            <a
                class="inline-flex items-center justify-center h-9 px-4 text-sm font-medium text-white bg-blue-800 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Inscribir
            </a>
        </div>
    </nav>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <p class="text-xl font-semibold text-gray-900 dark:text-white">Datos del estudiante</p>
        </div>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($dataEstudiante as $data)
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
            <p class="text-xl font-semibold text-gray-900 dark:text-white">Historial de programas</p>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Codigo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sigla
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modalidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha de finalizacion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programas as $programa)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $programa->honorifico }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $programa->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $programa->sigla }} {{ $programa->version }} - {{ $programa->edicion }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $programa->modalidad }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $programa->fecha_finalizacion }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $programa->estado }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('programa.show', $programa->id) }}"
                                class="text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <x-iconos.view />
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
