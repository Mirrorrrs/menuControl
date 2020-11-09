@extends('layouts.app')

@section("content")
<div class="container">

    @if(collect($menus)->isNotEmpty())
      @foreach($menus as $menu)
          <div class="cards">
              <div class="card mt-1" >
                  <div class="card-body d-flex align-items-center justify-content-between">
                      <h3 class="card-title m-0">
                          {{$menu->menu_name}}
                      </h3>
                      <div class="links">
                          <a href="{{route("menu",$menu->id)}}" class="card-link">Редактировать</a>
                          <a href="{{route("delete-menu",$menu->id)}}" class="card-link text-danger">Удалить</a>
                      </div>

                  </div>
              </div>
          </div>


        @endforeach
    @else
       <h2 class="font-weight-bold text-center mt-2">Здесь пока пустовато, добавьте меню!</h2>
    @endif
    <div class="container-fluid d-flex justify-content-center mt-3 p-0">
        <form class="container-fluid p-0" action="{{route("create-menu")}}" method="post">
            @csrf
            <div class="form-group d-flex">
                <input type="text" class="form-control " name="menu_name" placeholder="Название меню">
                <button class="btn btn-primary flex-grow-1 flex-shrink-0">Добавить меню</button>
            </div>
        </form>
    </div>

        @error('menu_name')
        <span class="invalid mt-3" style="color: #e3342f;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror




</div>


@endsection
