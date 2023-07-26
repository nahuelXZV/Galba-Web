<div>
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-500">Nuevo</span>
                </div>
            </li>
        </ol>
        <div>
            <button onclick="validarFormulario()? Livewire.emit('store') : ''"
                class="inline-flex items-center justify-center h-9 px-4 ml-5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                Guardar
            </button>
        </div>
    </nav>

    <form class="grid grid-cols-3 gap-3" name="formulario">
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Codigo</label>
            <input type="text" wire:model.defer="moduloArray.codigo_modulo" id="codigo_modulo" name="codigo_modulo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba el codigo" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" wire:model.defer="moduloArray.nombre" id="nombre" name="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba el nombre" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sigla</label>
            <input type="text" wire:model.defer="moduloArray.sigla" id="sigla" name="sigla"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba la sigla" required>
        </div>
        <div class="mb-6">
            <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edicion</label>
            <input type="number" wire:model.defer="moduloArray.edicion" id="edicion" name="edicion"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba la edicion" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Version</label>
            <input type="number" wire:model.defer="moduloArray.version" id="version" name="version"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba la version" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Inicio</label>
            <input type="date" wire:model.defer="moduloArray.fecha_inicio" id="fecha_inicio" name="fecha_inicio"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Fin</label>
            <input type="date" wire:model.defer="moduloArray.fecha_finalizacion" id="fecha_finalizacion"
                name="fecha_finalizacion"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el programa</label>
            <select wire:model.defer="moduloArray.programa_id" id="programa_id" name="programa_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona un programa</option>
                @foreach ($programas as $programa)
                    <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el docente</label>
            <select wire:model.defer="moduloArray.docente_id" id="docente_id" name="docente_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona un docente</option>
                @foreach ($docentes as $docente)
                    <option value="{{ $docente->id }}">
                        {{ $docente->nombre }} {{ $docente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona la modalidad</label>
            <select wire:model.defer="moduloArray.modalidad" id="modalidad" name="modalidad" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona la modalidad</option>
                @foreach ($modalidades as $modalidades)
                    <option value="{{ $modalidades }}">{{ $modalidades }}</option>
                @endforeach
            </select>
        </div>
    </form>

    @push('scripts')
        <script>
            function validarFormulario() {

                var codigo_modulo = document.forms["formulario"]["codigo_modulo"];
                var nombre = document.forms["formulario"]["nombre"];
                var sigla = document.forms["formulario"]["sigla"];
                var edicion = document.forms["formulario"]["edicion"];
                var version = document.forms["formulario"]["version"];
                var modalidad = document.forms["formulario"]["modalidad"];
                var fecha_finalizacion = document.forms["formulario"]["fecha_finalizacion"];
                var fecha_inicio = document.forms["formulario"]["fecha_inicio"];
                var modalidad = document.forms["formulario"]["modalidad"];
                var programa_id = document.forms["formulario"]["programa_id"];
                var docente_id = document.forms["formulario"]["docente_id"];

                if (!validarCampo(codigo_modulo, "string", 0)) {
                    return false;
                }
                if (!validarCampo(nombre, "string", 0)) {
                    return false;
                }
                if (!validarCampo(sigla, "string", 0)) {
                    return false;
                }
                if (!validarCampo(edicion, "number", 0)) {
                    return false;
                }
                if (!validarCampo(version, "number", 0)) {
                    return false;
                }
                if (!validarCampo(modalidad, "string", 0)) {
                    return false;
                }
                if (!validarCampo(fecha_finalizacion, "date", 0)) {
                    return false;
                }
                if (!validarCampo(fecha_inicio, "date", 0)) {
                    return false;
                }
                if (!validarCampo(programa_id, "number", 0)) {
                    return false;
                }
                if (!validarCampo(docente_id, "number", 0)) {
                    return false;
                }
                return true;
            }
        </script>
    @endpush
    @push('visitas')
        {{ $visitas }}
    @endpush
</div>
