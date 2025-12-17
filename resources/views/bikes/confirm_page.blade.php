<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment Success Andaman Bliss</title>
</head>

<body>
  <div style="
      margin: 0;
      padding: 20px;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
    ">
    <!-- Main Container -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0"
      style="width: 100%; max-width: 500px; margin: 0 auto;">
      <tr>
        <td>
          <!-- Payment Card -->
          <table role="presentation" cellspacing="0" cellpadding="0" border="0"
            style="
              width: 100%;
              background: white;
              border-radius: 12px;
              box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
              overflow: hidden;
            ">
            <!-- Success Header -->
            <tr>
              <td style="
                  position: relative;
                  padding: 32px;
                  text-align: center;
                  color: white;
                  background-image: url('{{ asset("images/rental_bike.jpg") }}');
                  background-size: cover;
                  background-position: center;
                ">
                <!-- Background overlay -->
                <div style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.45);
                    z-index: 1;
                  "></div>

                <!-- Foreground content -->
                <div style="position: relative; z-index: 2;">
                  <!-- Success Icon -->
                  <div style="
                      width: 60px;
                      height: 60px;
                      background: #34a853;
                      border-radius: 50%;
                      display: inline-flex;
                      align-items: center;
                      justify-content: center;
                      margin: 0 auto 16px;
                      box-shadow: 0 4px 12px rgba(52, 168, 83, 0.3);
                    ">
                    <span style="font-size: 40px; color: white; font-weight: bold;">✓</span>
                  </div>

                  <!-- Amount -->
                  <h1 style="
                      font-size: 40px;
                      font-weight: 600;
                      margin: 0;
                      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                      color: white;
                    ">
                    {{ number_format($billingDetails->payment->amount, 2) ?? '' }}
                  </h1>

                  <!-- Status -->
                  <p style="
                      font-size: 18px;
                      opacity: 0.9;
                      margin: 8px 0 0 0;
                      color: white;
                    ">
                    Paid Successfully
                  </p>
                </div>
              </td>
            </tr>

            <!-- Payment Details -->
            <tr>
              <td style="padding: 32px;">
                <!-- Payment ID -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                  style="width: 100%; border-bottom: 1px solid #e9ecef; padding-bottom: 16px; margin-bottom: 16px;">
                  <tr>
                    <td style="color: #6c757d; font-weight: 500; font-size: 15px;">Payment Id</td>
                    <td style="color: #495057; font-weight: 500; text-align: right; font-size: 15px;">
                      #AB-{{ str_pad($billingDetails->id, 6, '0', STR_PAD_LEFT) }}
                    </td>
                  </tr>
                </table>

                <!-- Rental -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                  style="width: 100%; border-bottom: 1px solid #e9ecef; padding-bottom: 16px; margin-bottom: 16px;">
                  <tr>
                    <td style="color: #6c757d; font-weight: 500; font-size: 15px;">Rental</td>
                    <td style="text-align: right;">
                      <div style="color: #495057; font-weight: 500; font-size: 15px;">
                        {{ $cab->name }} × {{ $billingDetails->cab_quantity }}
                      </div>
                      <div style="color: #6c757d; font-size: 13px; margin-top: 2px;">
                        at {{ $billingDetails->from_location }}
                      </div>
                    </td>
                  </tr>
                </table>

                <!-- Paid On -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                  style="width: 100%; border-bottom: 1px solid #e9ecef; padding-bottom: 16px; margin-bottom: 16px;">
                  <tr>
                    <td style="color: #6c757d; font-weight: 500; font-size: 15px;">Paid On</td>
                    <td style="color: #495057; font-weight: 500; text-align: right; font-size: 15px;">
                      {{ $billingDetails->payment->created_at->format('d M Y, H:i A') }}
                    </td>
                  </tr>
                </table>

                <!-- Email -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                  style="width: 100%; border-bottom: 1px solid #e9ecef; padding-bottom: 16px; margin-bottom: 16px;">
                  <tr>
                    <td style="color: #6c757d; font-weight: 500; font-size: 15px;">Email</td>
                    <td style="text-align: right;">
                      <a href="mailto:{{ $billingDetails->payment->email }}" style="
                          color: #4285f4;
                          text-decoration: none;
                          font-weight: 500;
                          font-size: 15px;
                        ">
                        {{ $billingDetails->payment->email }}
                      </a>
                    </td>
                  </tr>
                </table>

                <!-- Mobile -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                  style="width: 100%; border-bottom: 1px solid #e9ecef; padding-bottom: 16px; margin-bottom: 16px;">
                  <tr>
                    <td style="color: #6c757d; font-weight: 500; font-size: 15px;">Mobile Number</td>
                    <td style="text-align: right;">
                      <a href="tel:{{ $billingDetails->payment->phone }}" style="
                          color: #4285f4;
                          text-decoration: none;
                          font-weight: 500;
                          font-size: 15px;
                        ">
                        {{ $billingDetails->payment->phone }}
                      </a>
                    </td>
                  </tr>
                </table>

                <!-- Confirmation note -->
                <p style="margin: 8px 0 0; color: #6c757d; font-size: 14px; text-align: center;">
                  Confirmation details will be sent to <strong>{{ $billingDetails->payment->email }}</strong>
                </p>
              </td>
            </tr>

            <!-- Contact Information -->
            <tr>
              <td style="
                  background: #f8f9fa;
                  padding: 24px;
                  text-align: center;
                  color: #6c757d;
                  font-size: 14px;
                  line-height: 1.6;
                ">
                <p style="margin: 0;">
                  For any order-related queries please reach out to
                  <span style="color: #4285f4; font-weight: 600;">ANDAMAN BLISS PRIVATE LIMITED</span>
                  at
                  <a href="mailto:info@andamanbliss.com" style="color: #4285f4; text-decoration: none;">
                    info@andamanbliss.com
                  </a>
                  or call <strong style="color: #495057;">8900909900</strong>
                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>
