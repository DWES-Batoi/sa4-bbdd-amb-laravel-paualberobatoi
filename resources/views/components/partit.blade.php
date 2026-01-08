@props(['local', 'visitant', 'golsLocal', 'golsVisitant', 'estadi', 'data'])

<div class="border rounded-lg shadow-md p-6 bg-white text-center">
    <div class="text-sm text-gray-500 mb-2">
        {{ \Carbon\Carbon::parse($data)->format('d/m/Y - H:i') }}
    </div>
    
    <div class="flex justify-around items-center">
        <div class="w-1/3">
            <h2 class="text-xl font-bold text-blue-800">{{ $local }}</h2>
        </div>
        
        <div class="w-1/3 text-3xl font-mono font-black bg-gray-100 py-2 rounded">
            @if($golsLocal !== null)
                {{ $golsLocal }} - {{ $golsVisitant }}
            @else
                vs
            @endif
        </div>

        <div class="w-1/3">
            <h2 class="text-xl font-bold text-blue-800">{{ $visitant }}</h2>
        </div>
    </div>

    <div class="mt-4 pt-4 border-t text-gray-600">
        <strong>Estadi:</strong> {{ $estadi }}
    </div>
</div>