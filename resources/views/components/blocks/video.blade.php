@props(['data' => []])

<div class="mb-5 video-block">
    @if($data['title'])
    <h3 class="h5-semi-bold mb-3">{{ $data['title'] }}</h3>
    @endif
    <div class="ratio ratio-16x9 mb-3 bg-dark rounded overflow-hidden">
        <video controls poster="https://via.placeholder.com/800x450" class="w-100 h-100 object-cover">
            <source src="#" type="video/mp4">
            Il tuo browser non supporta il tag video.
        </video>
    </div>
    @if($data['transcription'])
    <div class="p-3 bg-light rounded border">
        <h4 class="h6-semi-bold mb-2">Trascrizione</h4>
        <p class="small mb-0">{{ $data['transcription'] }}</p>
    </div>
    @endif
</div>