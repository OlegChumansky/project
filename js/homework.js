/**
 * Created by user on 27.02.2017.
 */

function addLesson(lesson, day, number) {
    if (lesson.length === 0) {
        setToast("Введи предмет")
    } else {
        $.ajax({
            type: "POST",
            url: "ajax/ajax_add_lesson.php",
            data: {
                lesson: lesson,
                day: day,
                number: number
            },
            success: function () {
                setToast("Предмет добавлен");
            }
        });
    }
}

function addTask(lesson, day, number) {
    if (lesson.length === 0) {
        setToast("Введи задание")
    } else {
        $.ajax({
            type: "POST",
            url: "ajax/ajax_add_task.php",
            data: {
                lesson: lesson,
                day: day,
                number: number
            },
            success: function () {
                setToast("Задание добавлено");
            }
        });
    }
}