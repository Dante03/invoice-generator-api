<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Factura</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      background: #fff;
      font-family: Arial, sans-serif;
      font-size: 14px;
      color: #333;
    }
    .container {
      width: 100%;
      min-height: 100%;
      margin: 0 auto;
      padding: 20px;
      box-sizing: border-box;
      border: 1px solid #ddd;
      background: #fff;

      /* Para que se estire verticalmente */
      display: table;
      height: 100%;
    }
    .section {
      display: table-row;
      height: auto;
    }
    h1 {
      font-size: 24px;
      font-weight: bold;
      margin: 0 0 5px 0;
    }
    h2 {
      font-size: 16px;
      font-weight: bold;
      margin: 0 0 5px 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table th, table td {
      border: 1px solid #ccc;
      padding: 8px;
    }
    table th {
      background: #f0f0f0;
      text-align: left;
    }
    table td.text-right {
      text-align: right;
    }
    .totals {
      text-align: right;
      margin-bottom: 20px;
    }
    .totals p {
      margin: 2px 0;
    }
    .totals strong {
      font-size: 16px;
    }
    .notes {
      margin-top: 20px;
    }
    .notes h3 {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .logo {
      width: 100%;
      max-width: 120px;
      height: 120px;
      border: 1px solid #ccc;
      background: #eee;
      text-align: center;
      vertical-align: middle;
      font-size: 12px;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="container">

    <!-- Encabezado -->
    <div class="section">
      <table>
        <tr>
          <td style="vertical-align:top; width:80%;">
            <h1>Factura</h1>
            <p>Invoice No: ####</p>
            <p>Invoice Date: 01/26/2026</p>
            <p>Due Date: 01/26/2026</p>
          </td>
          <td style="vertical-align:top; width:20%;">
            <div class="logo">Logo aquí</div>
          </td>
        </tr>
      </table>
    </div>

    <!-- Empresa y Cliente -->
    <div class="section">
      <table>
        <tr>
          <td style="vertical-align:top; width:50%;">
            <h2>Empresa</h2>
            <p>Nombre de la empresa</p>
            <p>Dirección</p>
            <p>Teléfono</p>
            <p>Email</p>
          </td>
          <td style="vertical-align:top; width:50%;">
            <h2>Cliente</h2>
            <p>Nombre del cliente</p>
            <p>Dirección</p>
            <p>Teléfono</p>
            <p>Email</p>
          </td>
        </tr>
      </table>
    </div>

    <!-- Ítems -->
    <div class="section">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th class="text-right">Cantidad</th>
            <th class="text-right">Precio</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
            <tr>
              <td>{{ $item['id'] ?? '01' }}</td>
              <td>{{ $item['name'] }}</td>
              <td class="text-right">{{ $item['quantity'] }}</td>
              <td class="text-right">${{ number_format($item['price'], 2) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Totales -->
    <div class="section totals">
      <p>Subtotal: <strong>{{ number_format($totals['subtotal'], 2) }}</strong></p>
      <p>Tax (16%): <strong>{{ number_format($totals['tax_total'], 2) }}</strong></p>
      <p>Descuento (10%): <strong>{{ number_format($totals['discount_total'], 2) }}</strong></p>
      <p><strong>Total: {{ number_format($totals['total'], 2) }}</strong></p>
    </div>

    <!-- Notas -->
    <div class="section notes">
      <h3>Notas</h3>
      <p>Any additional comments.</p>
    </div>

  </div>
</body>
</html>
