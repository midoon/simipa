<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | Rekapitulasi</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 20px; padding: 10px;">
    <div style="text-align: center; padding: 20px;">
        <h1 style="font-weight: bold; font-size: 24px; margin: 10px 0;">REKAPITULASI PEMBAYARAN SISWA</h1>
        <h1 style="font-weight: bold; font-size: 24px; margin: 10px 0;">MI PANCASILA MOJOSARI MOJOKERTO</h1>
    </div>

    <div style="margin-bottom: 30px;">
        <div>
            <div
                style="display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: bold; font-size: 14px;">
                <span style="width:10%; text-align: left; white-space: nowrap;">Rombel</span>
                <span style="width: 1%; text-align: center;">:</span>
                <span style="width: 89%; text-align: left;">{{ $group }}</span>
            </div>
            <div
                style="display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: bold; font-size: 14px;">
                <span style="width:10%; text-align: left; white-space: nowrap;">Jenis</span>
                <span style="width: 1%; text-align: center;">:</span>
                <span style="width: 89%; text-align: left;">{{ $paymentType }}</span>
            </div>
            <div
                style="display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: bold; font-size: 14px;">
                <span style="width:10%; text-align: left; white-space: nowrap;">Tagihan per Kelas</span>
                <span style="width: 1%; text-align: center;">:</span>
                <span style="width: 89%; text-align: left;">{{ $totalAmount }}</span>
            </div>
            <div
                style="display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: bold; font-size: 14px;">
                <span style="width: 10%; text-align: left; white-space: nowrap;">Terbayar Per Kelas</span>
                <span style="width: 1%; text-align: center;">:</span>
                <span style="width: 89%; text-align: left;">{{ $totalPaidFeeAmount }}</span>
            </div>
        </div>
    </div>



    <div style="border: 1px solid #ccc; border-radius: 5px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead style="background-color: #708871; color: white;">
                <tr>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: center; width: 5%;">No</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: center;">Nama</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: center; width: 25%;">Tagihan</th>
                    <th style="border: 1px solid #ccc; padding: 10px; text-align: center; width: 25%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentData as $data)
                    <tr style="background-color: #f9f9f9; border: 1px solid #ccc;">
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: center;">{{ $loop->iteration }}
                        </td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: center;">{{ $data['name'] }}</td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: center;">
                            {{ $data['remainingAmount'] }}</td>
                        <td style="border: 1px solid #ccc; padding: 8px; text-align: center;">{{ $data['status'] }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>

</html>
