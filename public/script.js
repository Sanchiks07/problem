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
    if (!popup) return;

    const todayKey = `dailyReflectionShown-${new Date().toLocaleDateString()}`;

    // if already shown/submitted today, do nothing
    if (localStorage.getItem(todayKey)) return;

    // Pick a random time between 18:00 and 20:00
    const now = new Date();
    const start = new Date();
    start.setHours(18, 0, 0, 0); // 18:00
    const end = new Date();
    end.setHours(20, 0, 0, 0); // 20:00

    // if current time is past end, just show immediately
    const minDelay = now < start ? start.getTime() - now.getTime() : 0;
    const maxDelay = now < end ? end.getTime() - now.getTime() : 0;
    const delay = maxDelay > 0 ? minDelay + Math.floor(Math.random() * maxDelay) : 0;

    setTimeout(() => {
        popup.classList.add('show'); // fade in
        popup.style.display = 'flex';

        const closeBtn = document.getElementById('daily-popup-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                popup.classList.remove('show'); // fade out
                setTimeout(() => {
                    popup.style.display = 'none';
                }, 500);
                localStorage.setItem(todayKey, 'true');
            });
        }

        const form = popup.querySelector('form');
        if (form) {
            form.addEventListener('submit', () => {
                localStorage.setItem(todayKey, 'true');
            });
        }
    }, delay);
});


// calendar
document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const tasks = JSON.parse(calendarEl.dataset.tasks || '[]');
    const reflections = JSON.parse(calendarEl.dataset.reflections || '[]');
    const questions = JSON.parse(calendarEl.dataset.questions || '[]');

    const events = [];

    // Tasks (not clickable)
    tasks.forEach(task => {
        if (task.due_date) {
            events.push({
                title: task.title,
                start: task.due_date,
                classNames: ["task-event"],
                extendedProps: {
                    type: "task"
                }
            });
        }
    });

    // Reflections (clickable)
    reflections.forEach(reflection => {
        if (reflection.date) {
            events.push({
                title: "Daily Reflection",
                start: reflection.date,
                classNames: ["reflection-event"],
                extendedProps: {
                    type: "reflection",
                    responses: reflection.responses,
                    questions: questions
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
                const questions = info.event.extendedProps.questions || [];
                showReflectionModal(responses, questions);
            }
        }
    });

    calendar.render();
});

function showReflectionModal(responses, questions = []) {
    let content = "<h2>Daily Reflection</h2>";

    if (Array.isArray(responses)) {
        responses.forEach((answer, index) => {
            const questionText = Array.isArray(questions) && questions[index]
                ? questions[index]
                : `Q${index + 1}`;

            content += `<p class="reflection-question"><strong>${questionText}</strong></p>`;
            content += `<p class="reflection-answer">${answer}</p><hr>`;
        });
    } else {
        content += "<p>No responses found.</p>";
    }

    const modal = document.createElement('div');
    modal.innerHTML = `
        <div class="reflection-modal-backdrop">
            <div class="reflection-modal-content">
                ${content}
                <button id="closeReflection">Close</button>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    document.getElementById('closeReflection').addEventListener('click', function() {
        modal.remove();
    });
}