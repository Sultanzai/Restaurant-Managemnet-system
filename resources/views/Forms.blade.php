<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم مینیمالیستی</title>
    <style>
        body {
            font-family: "Inter", Helvetica;
            font-size: 24px;
            background-color: #fff;
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            margin: 0;
        }
        .form-container {
            border: 1px solid #000;
            padding: 20px;
            width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 95%;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 4px;
            background-color: #fff;
            color: #000;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group .checkbox-group {
            display: flex;
            align-items: center;
        }
        .form-group .checkbox-group input {
            width: auto;
            margin-left: 10px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 4px;
            background-color: #000;
            color: #fff;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>فرم مینیمالیستی</h2>
        <form>
            <div class="form-group">
                <label for="name">نام:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="name">قیمت:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="name">تعداد:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">توضیحات:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">دسته‌ بندی:</label>
                <select id="category" name="category" required>
                    <option value="">انتخاب کنید</option>
                    <option value="category1">دسته‌ بندی 1</option>
                    <option value="category2">دسته‌ بندی 2</option>
                    <option value="category3">دسته‌ بندی 3</option>
                </select>
            </div>
            <div class="form-group checkbox-group">
                <label for="agree">موافقت:</label>
                <input type="checkbox" id="agree" name="agree" required>
                <input type="checkbox" id="agree" name="agree" required>
                <input type="checkbox" id="agree" name="agree" required>
            </div>
            <div class="form-group">
                <button type="submit">ارسال</button>
            </div>
        </form>
    </div>
</body>
</html>
