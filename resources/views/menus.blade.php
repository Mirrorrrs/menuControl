@extends("templates.main")

@section("content")
<div class="container-fluid">

    @if(collect($menus)->isNotEmpty())
      @foreach($menus as $menu)
           <div class="container-fluid d-flex align-items-center justify-content-between bg-white p-3 mt-2" style="border:1px solid #495057 !important; border-radius: 5px">
               <h5 class="m-0">{{$menu->menu_name}}</h5>
               <a href="{{route("menu",$menu->id)}}">Редактировать -></a>
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




</div>


@endsection
