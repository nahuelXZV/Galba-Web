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
                    <a href="{{ route('estudiante.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Estudiantes</a>
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
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el honorifico</label>
            <select wire:model.defer="estudianteArray.honorifico" id="honorifico" name="honorifico" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona un honorifico</option>
                @foreach ($honorificos as $honorifico)
                    <option value="{{ $honorifico }}">{{ $honorifico }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" wire:model.defer="estudianteArray.nombre" id="nombre" name="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba su nombre" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido</label>
            <input type="text" wire:model.defer="estudianteArray.apellido" id="apellido" name="apellido"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba su Apellido" required>
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
            <input type="email" wire:model.defer="estudianteArray.correo" id="correo" name="correo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba su correo" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
            <input type="number" wire:model.defer="estudianteArray.telefono" id="telefono" name="telefono"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba su telefono" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CI</label>
            <input type="number" wire:model.defer="estudianteArray.ci" id="ci" name="ci"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba su cedula de identidad" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el lugar de
                exp</label>
            <select wire:model.defer="estudianteArray.ci_expedicion" id="ci_expedicion" name="ci_expedicion" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona un lugar</option>
                @foreach ($ciExpediciones as $expediciones)
                    <option value="{{ $expediciones }}">{{ $expediciones }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Carrera</label>
            <input type="text" wire:model.defer="estudianteArray.carrera" id="carrera" name="carrera"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba la Carrera" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Universidad</label>
            <input type="text" wire:model.defer="estudianteArray.universidad" id="universidad" name="universidad"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba la universidad" required>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el sexo</label>
            <select wire:model.defer="estudianteArray.sexo" id="sexo" name="sexo" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona el sexo</option>
                @foreach ($sexos as $sexo)
                    <option value="{{ $sexo }}">{{ $sexo }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona la
                nacionalidad</label>
            <select wire:model.defer="estudianteArray.nacionalidad" id="nacionalidad" name="nacionalidad" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona la nacionalidad</option>
                @foreach ($nacionalidades as $nacionalidad)
                    <option value="{{ $nacionalidad }}">{{ $nacionalidad }}</option>
                @endforeach
            </select>
        </div>

    </form>

    @push('scripts')
        <script>
            function validarFormulario() {

                var honorifico = document.forms["formulario"]["honorifico"];
                var nombre = document.forms["formulario"]["nombre"];
                var apellido = document.forms["formulario"]["apellido"];
                var correo = document.forms["formulario"]["correo"];
                var ci = document.forms["formulario"]["ci"];
                var ci_expedicion = document.forms["formulario"]["ci_expedicion"];
                var telefono = document.forms["formulario"]["telefono"];
                var carrera = document.forms["formulario"]["carrera"];
                var universidad = document.forms["formulario"]["universidad"];
                var sexo = document.forms["formulario"]["sexo"];
                var nacionalidad = document.forms["formulario"]["nacionalidad"];

                if (!validarCampo(honorifico, "string", 0)) {
                    return false;
                }
                if (!validarCampo(nombre, "string", 0)) {
                    return false;
                }
                if (!validarCampo(apellido, "string", 0)) {
                    return false;
                }
                if (!validarCampo(correo, "email", 0)) {
                    return false;
                }
                if (!validarCampo(ci, "number", 0)) {
                    return false;
                }
                if (!validarCampo(ci_expedicion, "string", 0)) {
                    return false;
                }
                if (!validarCampo(telefono, "number", 0)) {
                    return false;
                }
                if (!validarCampo(carrera, "string", 0)) {
                    return false;
                }
                if (!validarCampo(universidad, "string", 0)) {
                    return false;
                }
                if (!validarCampo(sexo, "string", 0)) {
                    return false;
                }
                if (!validarCampo(nacionalidad, "string", 0)) {
                    return false;
                }
                return true;
            }
        </script>
    @endpush
</div>
