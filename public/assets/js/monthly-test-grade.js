function calculateGrade(mark) {
    if (mark >= 80) return 'A';
    else if (mark < 80 && mark >= 60) return 'B';
    else if (mark < 60 && mark >= 40) return 'C';
    else if (mark < 40) return 'D';
}

function updateGradeStyle(gradeInput) {
    // အရင် grade class တွေအကုန်ဖယ်ထုတ်
    gradeInput.classList.remove('grade-a', 'grade-b', 'grade-c', 'grade-d');
    
    // လက်ရှိ grade ပေါ်မူတည်ပြီး သက်ဆိုင်ရာ class ထည့်ပေး
    switch (gradeInput.value) {
        case 'A':
            gradeInput.classList.add('grade-a');
            break;
        case 'B':
            gradeInput.classList.add('grade-b');
            break;
        case 'C':
            gradeInput.classList.add('grade-c');
            break;
        case 'D':
            gradeInput.classList.add('grade-d');
            break;
    }
}

// Pass/Fail style update လုပ်ဖို့ function အသစ်
function updateResultStyle(resultInput) {
    resultInput.classList.remove('pass', 'fail');
    if (resultInput.value === 'Pass') {
        resultInput.classList.add('pass');
    } else if (resultInput.value === 'Fail') {
        resultInput.classList.add('fail');
    }
}

// Add event listeners to all mark input fields
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('studentsTable');
    
    // Grade inputs တွေကို style လုပ်
    const allGradeInputs = table.querySelectorAll('input[name$="[myanmar_grade]"], input[name$="[english_grade]"], input[name$="[math_grade]"], input[name$="[science_grade]"], input[name$="[social_grade]"], input[name$="[total_grade]"]');
    allGradeInputs.forEach(gradeInput => {
        updateGradeStyle(gradeInput);
    });

    // Result inputs တွေကို style လုပ်
    const resultInputs = table.querySelectorAll('input[name$="[result]"]');
    resultInputs.forEach(resultInput => {
        updateResultStyle(resultInput);
    });

    // မူလရှိပြီးသား mark input event listeners
    const markInputs = table.querySelectorAll('input[type="number"][name$="[myanmar_mark]"], input[type="number"][name$="[english_mark]"], input[type="number"][name$="[math_mark]"], input[type="number"][name$="[science_mark]"], input[type="number"][name$="[social_mark]"]');

    markInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Get the corresponding grade input
            const gradeInput = this.nextElementSibling;
            const mark = parseFloat(this.value) || 0;

            // Calculate and set grade
            gradeInput.value = calculateGrade(mark);
            updateGradeStyle(gradeInput);

            // Calculate total marks and grade for this student
            const row = this.closest('tr');
            const marks = [
                parseFloat(row.querySelector('input[name$="[myanmar_mark]"]').value) || 0,
                parseFloat(row.querySelector('input[name$="[english_mark]"]').value) || 0,
                parseFloat(row.querySelector('input[name$="[math_mark]"]').value) || 0,
                parseFloat(row.querySelector('input[name$="[science_mark]"]').value) || 0,
                parseFloat(row.querySelector('input[name$="[social_mark]"]').value) || 0
            ];

            const totalMark = marks.reduce((a, b) => a + b, 0);
            const avgMark = totalMark / 5;

            // Set total mark
            row.querySelector('input[name$="[total_mark]"]').value = totalMark;

            // Set and style total grade
            const totalGradeInput = row.querySelector('input[name$="[total_grade]"]');
            totalGradeInput.value = calculateGrade(avgMark);
            updateGradeStyle(totalGradeInput);

            // Set result (pass/fail)
            const resultInput = row.querySelector('input[name$="[result]"]');
            const failCount = marks.filter(mark => mark < 40).length;
            resultInput.value = failCount > 0 ? 'Fail' : 'Pass';
            updateResultStyle(resultInput);  // Result style ကို update လုပ်
        });
    });
});




// For Data table 
// Initialize DataTable
$(document).ready(function () {
    $('#studentsTable').DataTable({
        "pageLength": 25, // Adjust rows per page if needed
        "order": [[0, 'asc']], // Sort by the first column (Index) by default
        "columnDefs": [
            // { "type": "grade", "targets": [10] }, // Grade column (Total Grade)
            // { "type": "result", "targets": [11] }, // Result column (Pass/Fail)
            // { "type": "num", "targets": [4, 5, 6, 7, 8, 9] }, // Marks columns
            { "orderable": true, "targets": "_all" } // Ensure all columns are sortable
        ]
    });
});
