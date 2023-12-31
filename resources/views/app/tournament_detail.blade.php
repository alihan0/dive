@extends('app.master')

@section('content')
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{$tournament->cover}}" alt="Admin" class="w-100" height="225">
                            <div class="mt-3">
                                <h4>{{$tournament->title}}</h4>
                                <p class="text-secondary mb-4">{{$tournament->description}}</p>
                                @if ($tournament->status == 1)
                                    <button class="btn btn-primary" onclick="applyTournament({{$tournament->id}})">Apply</button>
                                @endif
                                
                            </div>
                        </div>
                        <hr class="my-4" />
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Type</h6>
                                <span class="text-secondary">{{$tournament->type_info['title']}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Max Participants</h6>
                                <span class="text-secondary">{{$tournament->max_participants}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Start at</h6>
                                <span class="text-secondary">{{$tournament->start_at}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">End at</h6>
                                <span class="text-secondary">{{$tournament->end_at}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Round</h6>
                                <span class="text-secondary">{{$tournament->round}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Status</h6>
                                <span class="text-secondary">{{$tournament->status_info['title']}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                @if ($tournament->status == 3)
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success border-success text-white d-flex justify-content-center align-items-center" role="alert">
                                <i class="fas fa-trophy fs-1 me-3"></i>
                                <span class="fw-bold fs-4">[{{$tournament->Winner->abbreviation}}] - {{$tournament->Winner->name}}</span>
                              </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Participants</h5>
        
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Team</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Member</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participants as $p)
                                            <tr>
                                                <td>
                                                    {{$p->id}}
                                                </td>
                                                <td>
                                                    [{{$p->Team->abbreviation}}] - {{$p->Team->name}}
                                                </td>
                                                <td>
                                                    {{$p->Team->ownerUser->name}}
                                                </td>
                                                <td>
                                                    {{$p->Team->members->count()}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Matches</h5>
                                
                                  
                                <div class="row">
                                    @php
                                        if($tournament->round > 4){
                                            $col = "col-4";
                                        }else{
                                            $col = "col";
                                        }
                                    @endphp
                                        
                                    @for ($i = 1; $i <= $tournament->round; $i++)
                                    <div class="{{$col}}">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Round {{$i}}</h5>
                                                <hr>

                                                @foreach ($matches->where('round',$i) as $item)
                                                <ul class="list-group mb-3">
                                                    <li class="list-group-item
                                                        @if($item->status == 2)
                                                            @if($item->winner == 1)
                                                            text-success
                                                            @else
                                                            text-danger
                                                            @endif
                                                        @else
                                                        text-white
                                                        @endif
                                                    ">[{{$item->Team1->abbreviation}}] - {{$item->Team1->name}}</li>
                                                    <li class="list-group-item
                                                    @if($item->status == 2)
                                                            @if($item->winner == 2)
                                                            text-success
                                                            @else
                                                            text-danger
                                                            @endif
                                                        @else
                                                        text-white
                                                        @endif
                                                    ">[{{$item->Team2->abbreviation}}] - {{$item->Team2->name}}</li>
                                                    @if ($item->MatchTime)
                                                    <li class="list-group-item text-white bg-info"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($item->MatchTime->match_time)->format('H:i, d F') }}
                                                    </li>
                                                    @endif
                                                    
                                                </ul>
                                                @endforeach
                                                  
                                            </div>
                                        </div>
                                    </div>
                                    @endfor

                                    
                                </div>




                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('script')
<script>

    function applyTournament(id){
        axios.post('/app/tournament/apply', {id:id}).then((res)=>{
            toastr[res.data.type](res.data.message)
            if(res.data.status){
                setInterval(() => {
                    window.location.reload();
                }, 500);
            }
        });
    }

    async function veriAl() {
    
        // axios.post işlemi tamamlandığında response değerini teams değişkenine ata
        var teamsResponse = await axios.post('/app/get_participants', { tournament: 1, round: 1 });
        
        // teamsResponse verisini teams değişkenine ata
         return teamsResponse.data;

}
    
    var a = veriAl()
    var max_round = 3;
    var round = 0;
    var matches = [];
    
    console.log(a)


function ekipleriEslendir(ekipListesi) {
    let yeniEslentiler = [];
    
    // Eşleşmeleri oluştur
    for (let i = 0; i < ekipListesi.length; i += 2) {
        const ekip1 = ekipListesi[i];
        const ekip2 = ekipListesi[i + 1];

        const mac = {
            takim1: ekip1,
            takim2: ekip2
        };

        yeniEslentiler.push(mac);
    }

    return yeniEslentiler;
}

// İlk turdaki eşleşmeleri oluştur
matches[round] = ekipleriEslendir(teams);

// Diğer turlardaki eşleşmeleri oluştur


console.log(matches);

$("#bracket").append('<ul>')

    matches[0].forEach(element => {
        $("#bracket").append('<li><span>'+element["takim1"]+'</span><hr><span>'+element["takim2"]+'</span></li>')

    });
$("#bracket").append('</ul>')
   


</script>
@endsection

@section('style')
    <style>

        
    </style>
@endsection