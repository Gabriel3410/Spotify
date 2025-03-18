<x-app-layout>
    <div class="genres">
        <div class="containerss">
            <h2 class="title">Escolha seus gêneros musicais favoritos</h2>
            <form class="formGenres" method="POST" action="{{ route('save.genres') }}">
                @csrf
                <div class="options">
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="Rock"> Rock
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="Pop"> Pop
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="Hip-Hop"> Hip-Hop
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="Jazz"> Jazz
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="K-Pop"> K-pop
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="Funk"> Funk
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="Pagode"> Pagode
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="Samba"> Samba
                    </label>
                </div>
                <button type="submit" class="button">Salvar e Continuar</button>
            </form>
        </div>
    </div>


</x-app-layout>
