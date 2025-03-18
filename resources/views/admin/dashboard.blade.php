<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Total de usuários cadastrados: $totalUsuarios") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container-admin" style="padding: 80px;">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Gerenciador de usuários') }}
                    </div>
                </div>
                <table class="table-fixed w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="w-1/4 border border-gray-300 px-4 py-2">ID</th>
                            <th class="w-1/4 border border-gray-300 px-4 py-2">Nome</th>
                            <th class="w-1/4 border border-gray-300 px-4 py-2">Email</th>
                            <th class="w-1/4 border border-gray-300 px-4 py-2">Admin</th>
                            <th class="w-1/4 border border-gray-300 px-4 py-2">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\User::all() as $user)
                            <tr class="text-center" style="color:white;">
                                <td class="border border-gray-300 px-4 py-2 ">{{ $user->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->is_admin ? 'Sim' : 'Não' }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if (auth()->id() !== $user->id)
                                        <form action="{{ route('admin.tornarAdmin', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="px-4 py-1 text-white font-semibold rounded
                                                {{ $user->is_admin ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }}">
                                                {{ $user->is_admin ? 'Remover Admin' : 'Tornar Admin' }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="container-admin" style="padding: 80px;">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Cadastro de Gênero musical ') }}
                    </div>

                    <div>
                        <a href="{{ route('admin.genres.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cadastrar Gênero
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                            Cadastrar Album
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
