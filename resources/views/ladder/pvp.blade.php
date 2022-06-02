@extends('layouts.app')

@section('title', 'Players')

@section('content')
<div class="container content">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><img src="{{plugin_asset('dofus129', "img/none.png")}}" alt="" srcset=""></th>
                    <th scope="col">Name</th>
                    <th scope="col">Level</th>
                    <th scope="col"><img src="{{plugin_asset('dofus129', "img/icones/none.png")}}" alt="" srcset=""></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($characters as $character)
                    <tr>
                        @php
                            $character_rank = $loop->iteration + ($characters->currentPage()-1) * $characters->perPage()
                        @endphp

                        <th scope="row">@if($character_rank < 4) <img src="{{plugin_asset('dofus129', "img/trophy/trophy_".$character_rank.".png")}}"> @else {{$character_rank}} @endif</th>
                        <td><img src="{{$character->avatar}}" alt="" srcset=""></td>
                        <td>{{$character->name}}</td>
                        <td>{{$character->level}}</td>
                        <td><img src="{{$character->alignement}}" alt="" srcset=""></td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    {{$characters->links()}}
</div>
@endsection