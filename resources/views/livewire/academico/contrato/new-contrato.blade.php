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
                    <a href="{{ route('docente.show', $docente->id) }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Docente</a>
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
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el modulo</label>
            <select wire:model.defer="contratoArray.modulo_id" id="modulo_id" name="modulo_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecciona un modulo</option>
                @foreach ($modulos as $modulo)
                    <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6 ">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Honorario</label>
            <input type="number" wire:model.defer="contratoArray.honorario" id="honorario" name="honorario"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba el honorario" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pagado</label>
            <div class="flex items-center space-x-2">
                <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                    <input wire:model.defer="contratoArray.pagado" type="radio" class="text-blue-600 form-radio"
                        name="pagado" value="1" required>
                    <span class="ml-2" {{ $contratoArray['pagado'] == 1 ? 'checked' : '' }}}>Si</span>
                </label>
                <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                    <input wire:model.defer="contratoArray.pagado" type="radio" class="text-blue-600 form-radio"
                        name="pagado" value="0" required>
                    <span class="ml-2" {{ $contratoArray['pagado'] == 0 ? 'checked' : '' }}>No</span>
                </label>
            </div>
        </div>
        <div class="mb-6 col-span-2">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Horario</label>
            <textarea wire:model.defer="contratoArray.horario" id="horario" name="horario" rows="3"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 resize-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Escriba el horario" required></textarea>
        </div>

    </form>

    @push('scripts')
        <script>
            function validarFormulario() {

                var honorario = document.forms["formulario"]["honorario"];
                var horario = document.forms["formulario"]["horario"];
                var modulo_id = document.forms["formulario"]["modulo_id"];

                if (!validarCampo(honorario, "number", 0)) {
                    return false;
                }
                if (!validarCampo(horario, "string", 5)) {
                    return false;
                }
                if (!validarCampo(modulo_id, "number", 0)) {
                    return false;
                }
                return true;
            }
        </script>
    @endpush
</div>
