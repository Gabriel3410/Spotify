<x-app-layout>
    <div class="genres">
        <div class="containerss">
            <h2 class="title">Escolha seus gêneros musicais favoritos</h2>
            <form class="formGenres" method="POST" action="{{ route('save.genres') }}">
                @csrf
                <div class="options">
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="rock"> Rock
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="pop"> Pop
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="hip-hop"> Hip-Hop
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="jazz"> Jazz
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="k-pop"> K-pop
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="funk"> Funk
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="pagode"> Pagode
                    </label>
                    <label class="label">
                        <input class="input" type="checkbox" name="genres[]" value="samba"> Samba
                    </label>
                </div>
                <button type="submit" class="button">Salvar e Continuar</button>
            </form>
        </div>
    </div>


</x-app-layout>
