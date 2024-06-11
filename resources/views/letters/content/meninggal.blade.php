@if ($data['death_place'] == 'RUMAH')
    <p class="last-bottom-letter">Tersebut diatas memang benar meninggal di rumahnya yang beralamat di {{ $data['death_address'] }} pada tanggal  {{ $data['death_date'] }}</p>
@else
    <p class="last-bottom-letter">Tersebut diatas memang benar meninggal di <span style="text-transform:capitalize;">{{ $data['death_place'] }}</span> yang beralamat di {{ $data['death_address'] }} pada tanggal  {{ $data['death_date'] }}</p>

@endif


<p class="last-bottom-letter">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
