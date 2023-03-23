import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import axios from 'axios';

var calendarEl = document.getElementById("calendar");

let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,listWeek",
    },
    // 日本語化
    locale: "ja",
    
    buttonText: {
        today: "今月",
        month: "月",
        week: "週",
        day: "日",
        list: "リスト"
    },
    
    // 日付クリックで飼育記録を登録するペットを選択表示
    selectable: true,
    select: function(info) {
        document.location.href = "/users/id/pets_index";
    },
    
    // イベントクリックで飼育記録の詳細ページを表示
    eventClick: function(info) {
        document.location.href = "/managements/" + info.event.id;
    },

    // managementsテーブルデータの取得
    events: function (info, successCallback, failureCallback) {
        axios
            .post("/schedule-get", {
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
                id: info.id
            })
            .then((response) => {
                // 追加したイベントを削除
                calendar.removeAllEvents();
                // カレンダーに読み込み
                successCallback(response.data);
            })
            .catch(() => {
                // バリデーションエラーなど
                alert("登録に失敗しました");
            });
    },
});
calendar.render();