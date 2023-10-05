<!DOCTYPE html>
<html>
  <head>
    <title>Send POST Request</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }

      h1 {
        color: #333;
      }

      div {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px;
        border-radius: 5px;
      }

      label {
        display: block;
        margin-bottom: 5px;
      }

      input[type="text"],
      input[type="number"] {
        width: 98%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
      }

      button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
      }

      button:hover {
        background-color: #0056b3;
      }

      #response {
        margin-top: 20px;
      }
    </style>
  </head>

  <body>
<h1>Send a POST Request</h1>
    <div>
      <!-- Create a Laravel form -->
      <form method="POST" action="{{ route('group_poster') }}">
        @csrf
        <label for="message">Message:</label>
        <textarea
          id="message"
          name="message"
          cols="80"
          rows="30"
          style="direction: rtl;"
        >كوبونات خصم  نون يصل ل 70٪ خصم اضافي  ( صالحة لـ مصر أو السعودية أو الإمارات ) مُفعلة ومُجربة
      ◀️ كوبونات نون مصر .. رمز الكوبون ==>

      ✅  MP82 ✅

      ◀️ كوبونات نون السعودية والإمارت .. رمز الكوبون ==>

      ✅ نون الخليج   FW116

      اذا كانت قيمة مشتراوتك أكثر من ٢٠٠ ريال او ٢٠٠ درهم أو ريال ( للسعودية والإمارات فقط ) استخدم الكوبون ==>  FW116
      ✅ كيفية تفعيل كود خصم نون ✅
      🟡 قم بالدخول إلى موقع نون.
      🟡 قم باختيار المنتج الذي تريد شراؤه.
      🟡 إنتقل إلى عربة التسوق وصفحة الدفع.
      🟡 في صفحة الدفع ستجد مكان لإضافة كوبون خصم نون.
      🟡 أضف كود خصم نون واضغط تفعيل للحصول على الخصم.
      كود خصم نون المميز تم تجربته بنجاح ويعمل بنسبة 100% بتاريخ اليوم
      #كود_خصم_نون_مصر
      #كود_خصم_نون_مصر_اليوم
      #كوبون_خصم_نون_مصر
      #نون_مصر
      #noon_code
      #noon_coupon
      #noon_egypt_code
      #noonegypt
      #كود_خصم_نون_السعودية
      #كود_خصم_نون_السعودية_اليوم
      #كوبون_خصم_نون_السعودية
      #نون_السعودية
      #noon_code
      #noon_coupon
      #noon_saudi_code
      #noonsaudi
      #كود_خصم_نون_الإمارات
      #كود_خصم_نون_الإمارات_اليوم
      #كوبون_خصم_نون_الإمارات
      #نون_الإمارات
      #noon_code
      #noon_coupon
      #FW116
      #MP82
      #noon_uae_code
      #Mo_Shaqa
      #nooneuae
        </textarea>

        <label for="delay">Delay Between Actions (in sec):</label>
        <input type="number" id="delay" name="delay" placeholder="Enter delay" value="2" />

        <label for="Postdelay">Delay Between Posts (in min):</label>
        <input type="number" id="Postdelay" name="Postdelay" placeholder="Enter delay" value="2" />

        <label for="ids">IDs (comma-separated):</label>
        <textarea
          id="ids"
          name="ids"
          placeholder="Enter IDs"
          rows="5"
          cols="40"
        ></textarea>
        <br />

        <button type="submit">Send</button>
      </form>
    </div>
    <div id="response">
      <!-- Display response from the server here -->
        @if(isset($responses))
            <div class="alert alert-success">
                {{ $responses }}
            </div>
        @endif
    </div>
  </body>
</html>
