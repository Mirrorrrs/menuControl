<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("bootstrap/css/bootstrap.css")}}">
    <script src="{{asset("bootstrap/js/bootstrap.js")}}" defer></script>
</head>
<body>
<main>
    <div class="container-fluid w-75 m-auto">
        @foreach($days as $day)
        <h2 class="mt-3">{{$day->day_name}}</h2>
        <form class=" day_form w-100" action="{{route("save-day")}}" method="post">
            @csrf
            <input type="hidden" name="day_id" value="{{$day->id}}">
            <input type="hidden" name="number" value="{{$week_id}}">
            <div class="continer-fluid form_{{$day->id}}">
                @foreach($day->this_week_meals as $meal)
                    <div class="form_group">
                        <select name="types[{{$meal->id}}]" class="mt-3" required>
                            <option value="1" @if($meal->meal_type==1) selected @endif>Завтрак</option>
                            <option value="2"  @if($meal->meal_type==2) selected @endif >Второй завтрак</option>
                            <option value="3"  @if($meal->meal_type==3) selected @endif>Обед</option>
                            <option value="4"  @if($meal->meal_type==4) selected @endif>Полдник</option>
                            <option value="5"  @if($meal->meal_type==5) selected @endif>Ужин</option>
                            <option value="6"  @if($meal->meal_type==6) selected @endif>Второй ужин</option>
                        </select>
                        <input class="form-control mt-1" type="text" name="meals[{{$meal->id}}]" value="{{$meal->meals}}">
                    </div>
                @endforeach
            </div>

            <div class="form_group">
                <button class="mt-2 btn btn-primary ">Сохранить</button>
                <a href="javascript:void(0)" class="add_meal" data-target = "form_{{$day->id}}">Добавить блюдо</a>
            </div>

        </form>
        @endforeach
    </div>
</main>


<script>
let meal_btns = document.querySelectorAll(".add_meal")
let new_count = 0
Array.from(meal_btns).forEach(el=>{
    el.onclick = ()=>{
        new_count++
        let EventTarget = document.querySelector(`.${el.getAttribute("data-target")}`)
        let proto = new DOMParser().parseFromString(" <div class=\"form_group\">\n" +
            "                      <select name=\"types[new_"+new_count+"]\" class=\"mt-3\" required>\n" +
            "                          <option value=\"1\">Завтрак</option>\n" +
            "                          <option value=\"2\"  >Второй завтрак</option>\n" +
            "                          <option value=\"3\" >Обед</option>\n" +
            "                          <option value=\"4\"  >Полдник</option>\n" +
            "                          <option value=\"5\"  >Ужин</option>\n" +
            "                          <option value=\"6\" >Второй ужин</option>\n" +
            "                      </select>\n" +
            "                      <input class=\"form-control mt-1\" type=\"text\" name=\"meals[new_"+new_count+"]\" value=\"{{$meal->meals}}\">\n" +
            "                  </div>","text/html").body.querySelector(".form_group")

        EventTarget.appendChild(proto)
    }
})
</script>
</body>
</html>
