<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erbil Air Quality</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .logo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

        .logo-container img {
            height: 50px;
            object-fit: contain;
        }

        .section-title {
            margin: 20px 0 10px;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .icon-box {
            font-size: 1.6rem;
            margin-right: 15px;
            color: #0d6efd;
        }

        .parameter-title {
            font-weight: 500;
            font-size: 0.95rem;
            color: #555;
        }

        .parameter-value {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .timestamp {
            font-size: 0.8rem;
            color: #6c757d;
            margin-left: auto;
            text-align: right;
            min-width: fit-content;
        }

        .timestamp i {
            margin-right: 4px;
        }

        .card-content {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .sensor-info {
            display: flex;
            align-items: center;
            flex: 1;
        }
    </style>
</head>
<body>

<div class="container py-4">

    <!-- Logos -->
    <div class="container py-4 d-flex justify-content-center align-items-center">
        <div class="d-flex gap-3">
            <img src="https://time-net.net/images/logo-dark.png" alt="TimeNet" class="img-fluid"
                 style="max-height: 60px;">
            <img src="https://time-net.net/images/map-logo.jpg" alt="Map Group" class="img-fluid"
                 style="max-height: 80px;">
        </div>
    </div>

    <!-- Air Quality Section -->
    <div class="section-title">Meteorological Parameters</div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">

        @foreach($metrologicalSensors as $sensor)
            <div class="col">
                <div class="card p-3">
                    <div class="card-content">
                        <div class="sensor-info">
                            <div class="icon-box"><i class="fas {{ $sensor->icon }}"></i></div>
                            <div>
                                <div class="parameter-title">{{ $sensor->name }}</div>
                                <div class="parameter-value">{{ $sensor->value . $sensor->unit }}</div>
                            </div>
                        </div>
                        <div class="timestamp">
                            {{ $sensor->last_updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Gases Section -->
    <div class="section-title mt-4">Air Quality (Gases) Parameters</div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        @foreach($airQualitySensors as $sensor)
            <div class="col">
                <div class="card p-3">
                    <div class="card-content">
                        <div class="sensor-info">
                            <div class="icon-box"><i class="fas {{ $sensor->icon }}"></i></div>
                            <div>
                                <div class="parameter-title">{{ $sensor->name }}</div>
                                <div class="parameter-value">{{ $sensor->value }}</div>
                            </div>
                        </div>
                        <div class="timestamp">
                            {{ $sensor->last_updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
