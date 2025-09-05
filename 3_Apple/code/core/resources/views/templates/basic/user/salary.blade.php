@extends('layouts.users')


@section('content')

<style>
        body {
            background-color: #f0f4f8;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .task-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        .task-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .task-header i {
            font-size: 20px;
            color: #007bff;
            margin-right: 10px;
        }
        .task-title {
            font-size: 16px;
            font-weight: bold;
            color: #333333;
        }
        .task-subtitle {
            font-size: 14px;
            color: #666666;
        }
        .task-reward {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-top: 10px;
        }
        .task-progress {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        .progress-bar {
            flex: 1;
            height: 8px;
            background-color: #e0e0e0;
            border-radius: 4px;
            margin-right: 10px;
            position: relative;
        }
        .progress {
            background-color: #007bff;
            height: 8px;
            border-radius: 4px;
            position: absolute;
            top: 0;
            left: 0;
        }
        .progress-text {
            font-size: 14px;
            color: #666666;
        }
        .invite-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
<body>
    <div class="container">
        <h2>Salary</h2>
        <div class="task-card">
            <div class="task-header">
                <i class="ri-calendar-check-fill"></i>
                <div>
                    <div class="task-title">Inviting new members</div>
                    <div class="task-subtitle">Weekly Salary</div>
                </div>
            </div>
            <div class="task-reward">R2500.00</div>
            <div class="task-progress">
                <div class="progress-bar">
                    <div class="progress" id="progress-bar" style="width: 0;"></div>
                </div>
                <div class="progress-text" id="progress-text"></div>
            </div>
            <button style="border:none;" type="button" onclick="claimReward(2500)" class="invite-button" href="#">Claim Salary</button>
        </div>
    </div>
    
    @include('templates.basic.partials.footer')

    <script>
        // Define the progress values
        const current = {{ $referralsCount }}; // Current progress value
        const total = 1000; // Total target value

        // Calculate the progress percentage
        const percentage = (current / total) * 100;

        // Update the progress bar and text dynamically
        document.getElementById('progress-bar').style.width = percentage + '%';
        document.getElementById('progress-text').textContent = `${current} / ${total}`;
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function claimReward(amount) {
            $.ajax({
                url: "{{ route('user.invite') }}", // Use named route
                type: "POST",
                data: {
                    amount: amount
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                },
                success: function(response) {
                    message(response.message || 'Reward claimed successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                    message(xhr.responseText);
                }
            });
        }
    </script>
    
</body>


@endsection