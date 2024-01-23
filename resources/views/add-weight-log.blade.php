<!-- resources/views/add-weight-log.blade.php -->

<form action="{{ route('save-weight-log') }}" method="post">
    @csrf
    <!-- Add your form fields here (e.g., date, weight) -->

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <div class="mb-3">
        <label for="weight" class="form-label">Weight</label>
        <input type="number" class="form-control" id="weight" name="weight" step="0.1" required>
    </div>

    <!-- Add any other form fields as needed -->

    <button type="submit" class="btn btn-primary">Save</button>
</form>
