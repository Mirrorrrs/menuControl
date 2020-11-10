@extends('layouts.app')

@section("content")
    <div class="container">
        @foreach($days as $day)
            <div class="card mt-2">
                <div class="card-body">
                    <h2 class="card-title m-0">{{\Illuminate\Support\Facades\Lang::get("messages.".$day->day_name,[],"ru")}}</h2>
                    <form class=" day_form w-100" action="{{route("save-menu")}}" method="post">
                        @csrf
                        <input type="hidden" name="day_id" value="{{$day->id}}">
                        <input type="hidden" name="menu_id" value="{{$menu_id}}">
                        <div class="continer-fluid form_{{$day->id}}">
                            @foreach($day->meals as $meal)
                                <div class="form_group">
                                    <select name="types[{{$meal->id}}]"
                                            class="mt-2 form-control select_type col-3 select_{{$day->id}}" required>
                                        <option value="default">Не указано</option>
                                        <option value="1" @if($meal->meal_type==1) selected @endif>Завтрак</option>
                                        <option value="2" @if($meal->meal_type==2) selected @endif >Второй завтрак
                                        </option>
                                        <option value="3" @if($meal->meal_type==3) selected @endif>Обед</option>
                                        <option value="4" @if($meal->meal_type==4) selected @endif>Полдник</option>
                                        <option value="5" @if($meal->meal_type==5) selected @endif>Ужин</option>
                                        <option value="6" @if($meal->meal_type==6) selected @endif>Второй ужин</option>
                                    </select>
                                    <input class="form-control mt-1" type="text" name="meals[{{$meal->id}}]"
                                           value="{{$meal->meals}}">
                                </div>
                            @endforeach
                        </div>

                        <div class="form_group d-flex justify-content-between align-items-center mt-2">
                            <button class="mt-2 btn btn-primary ">Сохранить</button>
                            <a href="javascript:void(0)" class="add_meal btn btn-success" data-target="{{$day->id}}">Добавить</a>
                        </div>

                    </form>
                </div>

            </div>
        @endforeach
    </div>

    <script>
        let meal_btns = document.querySelectorAll(".add_meal")
        let new_count = 0

        function bindSelects() {
            let select_types = document.querySelectorAll(".select_type")
            Array.from(select_types).forEach(el => {
                el.onchange = () => {
                    let val = el.value;
                    let el_relatives = Array.from(select_types).filter(el2 => el2.classList.contains(Array.from(el.classList).find(el => el.match('select_\\d+'))))
                    el_relatives.splice(el_relatives.indexOf(el), 1)
                    Array.from(el_relatives).forEach(el => {
                        Array.from(el.children).forEach(el2 => {
                            if (el2.value == val && el2.value != "default") {
                                el2.setAttribute("disabled", "disabled")
                            } else {
                                el.removeAttribute("disabled")
                            }
                        })
                    })
                }
            });
        }

        bindSelects()

        Array.from(meal_btns).forEach(el => {
            el.onclick = () => {
                new_count++
                let id = el.getAttribute("data-target")
                let EventTarget = document.querySelector(`.form_${id}`)
                if (EventTarget.children.length < 7) {
                    let proto = new DOMParser().parseFromString(" <div class=\"form_group\">\n" +
                        "                      <select name=\"types[new_" + new_count + "]\" class=\"mt-2 form-control select_type select_" + id + " col-3\" required>\n" +
                        "                          <option value=\"default\">Не указано</option>" +
                        "                          <option value=\"1\">Завтрак</option>\n" +
                        "                          <option value=\"2\"  >Второй завтрак</option>\n" +
                        "                          <option value=\"3\" >Обед</option>\n" +
                        "                          <option value=\"4\"  >Полдник</option>\n" +
                        "                          <option value=\"5\"  >Ужин</option>\n" +
                        "                          <option value=\"6\" >Второй ужин</option>\n" +
                        "                      </select>\n" +
                        "                      <input class=\"form-control mt-1\" type=\"text\" name=\"meals[new_" + new_count + "]\" >\n" +
                        "                  </div>", "text/html").body.querySelector(".form_group")

                    EventTarget.appendChild(proto)
                    bindSelects()
                    let select_types = document.querySelectorAll(".select_type")
                    Array.from(select_types).forEach(el=>{
                        el.onchange()
                    })
                }
            }
        })

    </script>
@endsection
