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
                    <a href="{{ route('inventario.list') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Activos</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-iconos.flecha />
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-500">Editar</span>
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
        <div class="col-span-3 mb-4">
            <div class="flex justify-center">
                <div class="flex flex-col justify-center">
                    <div class="flex justify-center">
                        @if ($foto)
                            <img src="{{ $foto->temporaryUrl() }}" class="object-cover w-40 h-40 rounded-lg shadow-lg">
                        @else
                            <img src="{{ $inventario->dir }}" class="object-cover w-40 h-40 rounded-lg shadow-lg">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Codigo</label>
            <input type="text" wire:model.defer="inventarioArray.codigo" id="codigo" name="codigo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba el codigo" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" wire:model.defer="inventarioArray.nombre" id="nombre" name="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba el nombre" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
            <input type="text" wire:model.defer="inventarioArray.modelo" id="modelo" name="modelo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba el modelo" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cantidad</label>
            <input type="number" wire:model.defer="inventarioArray.cantidad" id="cantidad" name="cantidad"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba la cantidad" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
            <input type="file" id="file" name="file" wire:model="foto"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unidad a la que
                pertenece</label>
            <input type="text" wire:model.defer="inventarioArray.unidad" id="unidad" name="unidad"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba la unidad" required>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el estado</label>
            <select wire:model.defer="inventarioArray.estado" id="estado" name="estado" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona un estado</option>
                @foreach ($estados as $estado)
                    <option value="{{ $estado }}">{{ $estado }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el tipo</label>
            <select wire:model.defer="inventarioArray.tipo" id="tipo" name="tipo" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona un tipo</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6 col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
            <textarea wire:model.defer="inventarioArray.descripcion" id="descripcion" name="descripcion" rows="3"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 resize-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba la descripcion"></textarea>
        </div>
    </form>

    @push('scripts')
        <script>
            function validarFormulario() {

                var codigo = document.forms["formulario"]["codigo"];
                var nombre = document.forms["formulario"]["nombre"];
                var unidad = document.forms["formulario"]["unidad"];
                var descripcion = document.forms["formulario"]["descripcion"];
                var estado = document.forms["formulario"]["estado"];
                var tipo = document.forms["formulario"]["tipo"];
                var modelo = document.forms["formulario"]["modelo"];
                var cantidad = document.forms["formulario"]["cantidad"];
                var file = document.forms["formulario"]["file"];

                if (!validarCampo(codigo, "string", 5)) {
                    return false;
                }
                if (!validarCampo(nombre, "string", 5)) {
                    return false;
                }
                if (!validarCampo(unidad, "string", 5)) {
                    return false;
                }
                if (!validarCampo(descripcion, "string", 5)) {
                    return false;
                }
                if (!validarCampo(estado, "string", 5)) {
                    return false;
                }
                if (!validarCampo(tipo, "string", 5)) {
                    return false;
                }
                if (!validarCampo(modelo, "string", 5)) {
                    return false;
                }
                if (!validarCampo(cantidad, "number", 0)) {
                    return false;
                }
                if (file.files.length == 0) {
                    alert("Seleccione una imagen");
                    return false;
                }
                if (file.files[0].size > 1000000) {
                    alert("La imagen es muy grande");
                    return false;
                }
                if (file.files[0].type != "image/jpeg" && file.files[0].type != "image/png") {
                    alert("La imagen debe ser de tipo jpg o png");
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
