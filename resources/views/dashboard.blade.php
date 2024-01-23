<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{--  {{ __("You're logged in!") }}  --}}

                    {{--  <!-- Include Chart.js and Moment.js -->  --}}
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>


                    <button type="button" class="btn btn-primary" onclick="toggleModalBody()">
                        Add Weight Log
                    </button>


                    <canvas id="weightChart" width="400" height="200"></canvas>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {

                            const jsonData = @json($weightEntries);
                            // Parse JSON data
                            const parsedData = jsonData.map(entry => ({
                                x: new Date(entry.date),
                                y: entry.weight
                            }));

                            // Set up Chart.js with Moment.js adapter
                            const ctx = document.getElementById('weightChart').getContext('2d');
                            const chart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    datasets: [{
                                        label: 'Weight Tracker',
                                        borderColor: 'rgb(75, 192, 192)',
                                        data: parsedData,
                                        fill: false
                                    }]
                                },
                                options: {
                                    scales: {
                                        x: {
                                            type: 'time',
                                            time: {
                                                unit: 'day',
                                                parser: 'YYYY-MM-DD', // Add this line
                                                tooltipFormat: 'll', // Add this line
                                            },
                                            title: {
                                                display: true,
                                                text: 'Date'
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Weight'
                                            }
                                        }
                                    }
                                }
                            });

                            // Future projections/predictions logic
                            const futureProjections = predictFutureWeights(jsonData, 90); // Predict the next 90 days
                            const projectedData = futureProjections.map(entry => ({
                                x: new Date(entry.date),
                                y: entry.weight
                            }));

                            // Add projected data to the chart
                            chart.data.datasets.push({
                                label: 'Projected Weight',
                                borderColor: 'rgb(255, 99, 132)',
                                data: projectedData,
                                fill: false
                            });

                            // Update the chart
                            chart.update();
                        });

                        // Function to predict future weights based on average loss from past data points
                        function predictFutureWeights(data, days) {
                            const projections = [];

                            const averageLoss = calculateAverageLoss(data.slice(-10));

                            // Calculate the starting date (a week later than the latest data point)
                            const lastDate = new Date(data[data.length - 1].date);
                            const startDate = new Date(lastDate.getTime() + 1 * 24 * 60 * 60 * 1000); // Adding 7 days in milliseconds

                            for (let i = 0; i < days; i++) {
                                const currentDate = new Date(startDate);
                                currentDate.setDate(startDate.getDate() + i * 7); // Increment the date by 7 days

                                const projectedWeight = data[data.length - 1].weight - averageLoss * (i + 1);
                                projections.push({
                                    date: currentDate.toISOString().split('T')[0],
                                    weight: projectedWeight
                                });
                            }

                            return projections;
                        }


                        // Function to calculate the average weight loss from a set of data points
                        function calculateAverageLoss(data) {
                            if (data.length < 2) {
                                return 0;
                            }

                            const totalLoss = data.reduce((sum, entry, index, array) => {
                                if (index < array.length - 1) {
                                    return sum + (entry.weight - array[index + 1].weight);
                                } else {
                                    return sum;
                                }
                            }, 0);

                            return totalLoss / (data.length - 1);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div id="weightLogModalBody"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 max-w-md w-full p-6 bg-white border rounded-md shadow-md">
        <!-- Include the content of your add-weight-log.blade.php here -->
        @include('add-weight-log')
        <button type="button" class="btn btn-secondary mt-4" onclick="toggleModalBody()">Close</button>
    </div>

    <script>
        function toggleModalBody() {
            const modalBody = document.getElementById('weightLogModalBody');
            modalBody.classList.toggle('hidden');
        }
    </script>


</x-app-layout>
