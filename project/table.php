<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calendar with Bootstrap 5</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tempus Dominus Bootstrap 4 DateTime Picker CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Calendar with Bootstrap 5</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary" type="button" id="todayBtn">Today</button>
                </div>
                <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" placeholder="Select date">
                <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Sun</th>
                        <th scope="col">Mon</th>
                        <th scope="col">Tue</th>
                        <th scope="col">Wed</th>
                        <th scope="col">Thu</th>
                        <th scope="col">Fri</th>
                        <th scope="col">Sat</th>
                    </tr>
                </thead>
                <tbody id="calendar-body">
                    <td
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS, Popper.js, and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Moment.js (required by Tempus Dominus) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Tempus Dominus Bootstrap 4 DateTime Picker JS -->
<script src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Your custom script -->
<script>
    $(document).ready(function () {
        // Initialize the DateTimePicker
        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment(),
            inline: true,
        });

        // Event listener for date selection
        $('#datepicker').on('change.datetimepicker', function (e) {
            var selectedDate = e.date;
            updateCalendar(selectedDate);
        });

        // Event listener for today button
        $('#todayBtn').on('click', function () {
            var today = moment();
            $('#datepicker').datetimepicker('date', today);
            updateCalendar(today);
        });

        // Initial population of the calendar
        updateCalendar(moment());
    });

    // Function to update the calendar based on selected date
    function updateCalendar(selectedDate) {
        // Clear existing calendar content
        $('#calendar-body').empty();

        // Your logic to update the calendar goes here
        // You can use selectedDate to determine the month and year
        // and update the #calendar-body accordingly

        // For example, populate the calendar with dates 1-31
        var startOfMonth = selectedDate.clone().startOf('month');
        var endOfMonth = selectedDate.clone().endOf('month');

        var currentDay = startOfMonth.clone();
        var row = $('<tr>');

        // Add empty cells before the 1st day of the month
        for (var i = 0; i < currentDay.day(); i++) {
            row.append($('<td>'));
        }

        while (currentDay.isSameOrBefore(endOfMonth, 'day')) {
            if (currentDay.day() === 0 && row.children().length > 0) {
                $('#calendar-body').append(row);
                row = $('<tr>');
            }

            var cell = $('<td>').text(currentDay.date());
            row.append(cell);

            currentDay.add(1, 'day');
        }

        // Add the last row if it's not empty
        if (row.children().length > 0) {
            $('#calendar-body').append(row);
        }
    }
</script>
</body>
</html>
