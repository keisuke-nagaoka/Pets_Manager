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
    
    // 日付の"日"を非表示にする
    dayCellContent: function(info) {
        // 日付の数字部分だけを取り出す
        var date = info.date.getDate();
        
        // 日付の「日」を取り除く
        var dayNumberText = String(date).replace('日', '');
        
        // 土曜日のセルにfc-satクラス、日曜日のセルにfc-sunクラスを割り当てる
        if (info.date.getDay() === 6) {
            return {
                html: '<span class="fc-daygrid-day-number">' + dayNumberText + '</span>',
                classList: ['fc-daygrid-day-number', 'fc-sat']
            };
        } else if (info.date.getDay() === 0) {
            return {
                html: '<span class="fc-daygrid-day-number">' + dayNumberText + '</span>',
                classList: ['fc-daygrid-day-number', 'fc-sun']
            };
        } else {
            return {
                html: '<span class="fc-daygrid-day-number">' + dayNumberText + '</span>',
                classList: ['fc-daygrid-day-number']
            };
        }
    },

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
    
/* 記述の検討中

    editable: true,
    
    // イベントドロップで飼育記録の登録日時を変更
    eventDrop: function(info) {
        if (!confirm("飼育記録の登録日時を変更しますか？")) {
            info.revert();
            return;
        }
        
        let start = info.start_date.toISOString();
        let end = info.end_date.toISOString();
        let management_id = info.id;
        
        // 飼育記録の登録日時を変更する
        axios.patch(`/managements/${management_id}`, {
            start_date: start,
            end_date: end,
        }).then(response => {
            // 成功した場合、何もしない
            }).catch(error => {
            // エラーが発生した場合、変更前の日時に戻す
            info.revert();
            });
    },
*/

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