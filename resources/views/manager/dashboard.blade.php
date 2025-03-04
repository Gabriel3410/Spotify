<x-app-layout>

    <div class="container-admin" style="padding: 80px;">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Gerenciador de conteúdo') }}
                    </div>

                    <div>
                        <a href="{{ route('manager.create_artist') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cadastrar Artista
                        </a>

                        <a href="{{ route('manager.create_song') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Upload de Música
                        </a>

                        <a href="{{ route('manager.create_album') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Cadastrar album
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
