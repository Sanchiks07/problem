// auto-submits the reality anchor response form after 4 hours(the rotaion period)
const rotationSeconds = 4 * 60 * 60; 
const now = Math.floor(Date.now() / 1000);
const timeBlock = Math.floor(now / rotationSeconds);
const nextRotation = (timeBlock + 1) * rotationSeconds;
const secondsUntilNext = nextRotation - now;

setTimeout(() => {
    const form = document.getElementById('anchor-form');
    if (form) form.submit();
}, secondsUntilNext * 1000);

// starts the task and changes the tasks status
function startTask(taskId, redirectUrl) {
    fetch(`/tasks/${taskId}/start`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken,
            'Content-Type': 'application/json'
        },
    }).then(() => window.location.href = redirectUrl);
}

// daily reflection popup logic
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('daily-reflection-popup');
    if (!popup) return; // exit if popup doesn't exist

    const now = new Date();
    const todayKey = `dailyReflectionShown-${now.toLocaleDateString()}`;

    // if already shown or submitted today, do nothing
    if (localStorage.getItem(todayKey)) return;

    const start = new Date();
    start.setHours(18, 0, 0, 0); // 18:00
    const end = new Date();
    end.setHours(20, 0, 0, 0); // 20:00

    if (now >= start && now <= end) {
        const maxDelay = end.getTime() - now.getTime();
        const delay = Math.floor(Math.random() * maxDelay);

        setTimeout(() => {
            popup.style.display = 'block';

            // mark as shown if user closes manually
            const closeBtn = popup.querySelector('button[type="button"]');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    localStorage.setItem(todayKey, 'true');
                });
            }

            // mark as shown if user submits form
            const form = popup.querySelector('form');
            if (form) {
                form.addEventListener('submit', () => {
                    localStorage.setItem(todayKey, 'true');
                });
            }

        }, delay);
    }
});

// calendar
document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const tasks = JSON.parse(calendarEl.dataset.tasks || '[]');
    const reflections = JSON.parse(calendarEl.dataset.reflections || '[]');

    const events = [];

    // Tasks (not clickable)
    tasks.forEach(task => {
        if (task.due_date) {
            events.push({
                title: task.title,
                start: task.due_date,
                color: "#4CAF50"
            });
        }
    });

    // Reflections (clickable)
    reflections.forEach(reflection => {
        if (reflection.date) {
            events.push({
                title: "Daily Reflection",
                start: reflection.date,
                color: "#2196F3",
                extendedProps: {
                    type: "reflection",
                    responses: reflection.responses
                }
            });
        }
    });

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        firstDay: 1,
        events: events,
        eventClick: function(info) {

            if (info.event.extendedProps.type === "reflection") {

                const responses = info.event.extendedProps.responses;

                showReflectionModal(responses);
            }
        }
    });

    calendar.render();
});

function showReflectionModal(responses) {

    let content = "<h2>Daily Reflection</h2>";

    if (Array.isArray(responses)) {
        responses.forEach((answer, index) => {
            content += `<p><strong>Q${index + 1}:</strong></p>`;
            content += `<p>${answer}</p><hr>`;
        });
    } else {
        content += "<p>No responses found.</p>";
    }

    const modal = document.createElement('div');
    modal.innerHTML = `
        <div style="
            position: fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.6);
            display:flex;
            justify-content:center;
            align-items:center;
            z-index:9999;
        ">
            <div style="
                background:white;
                padding:30px;
                width:400px;
                max-width:90%;
                border-radius:16px;
                box-shadow:0 10px 30px rgba(0,0,0,0.2);
                max-height:80vh;
                overflow-y:auto;
            ">
                ${content}
                <button id="closeReflection" style="
                    margin-top:15px;
                    padding:8px 15px;
                    border:none;
                    background:#111;
                    color:white;
                    border-radius:8px;
                    cursor:pointer;
                ">Close</button>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    document.getElementById('closeReflection').addEventListener('click', function() {
        modal.remove();
    });
}