import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import axios from "axios";

var calendarEl = document.getElementById("calendar");

let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,listWeek",
    },
    locale: "ja",
    
    selectable: true,
    select: function (info) {
        // alert("selected " + info.startStr + " to " + info.endStr);
        
        const eventName = prompt("イベントを入力してください");
        
        if (eventName) {
            axios
                .post("/managements-add", {
                })
                .then(() => {
                    calendar.addEvent({
                        title: eventName,
                        start: info.start,
                        end: info.end,
                        allDay: true,
                    });
                })
                .catch(() => {
                    alert("登録に失敗しました");
                });
        }
    },
});
calendar.render();