# Myanmar's Academic Assessment System for Primary Levels

### **Run** the project using this command

> php -S localhost:8000 -t public

### Extensions

[PHP Block Comment](https://marketplace.visualstudio.com/items?itemName=imoca.php-doc-comment-vscode-plugin)

[Database](/core/db/academic-assessment-system.sql)

## Login Credentials

> admin =>
> admin@gmail.com,
> 12345678

> teacher default password => 123456

> teacher reset password => 12345678 (for common password)

## Admin

- Register teachers ✅
- View teachers information ✅
- View students information & results ✅
- Manage classes (Assign classes for teachers) ✅

## Teacher

| Features                             | KG  | G1  | G2  | G3  | G4  | G5  |
| ------------------------------------ | --- | --- | --- | --- | --- | --- |
| View students information            | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| View & update assessment by chapters | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| View & update assessment by months   | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| View & update monthly tests          | -   | -   | -   | -   | ✅  | ✅  |
| Calculate & announce QCPR            | -   | ✅  | ✅  | ✅  | ✅  | ✅  |
| CRUD Learning Resources              | ❌  | ❌  | ❌  | ❌  | ❌  | ❌  |

## Student

- Login ✅
- View QCPR ✅

## Grade Systems

#### Upper Grades (Grade 4-11)

- A, B, C, D grades
- ပျမ်းမျှအဆင့် တွက်ချက်ပုံ:
  - A = 4 points
  - B = 3 points
  - C = 2 points
  - D = 1 point

#### Lower Grades (Grade 1-3)

- A, S, E grades
- ပျမ်းမျှအဆင့် တွက်ချက်ပုံ:
  - A = 3 points
  - S = 2 points
  - E = 1 point

## Notes

- လစဉ်စာမေးပွဲရမှတ်များ အားလုံးပြည့်စုံမှသာ ပျမ်းမျှအဆင့် တွက်ချက်ပေးမည်
- Grade တွက်ချက်ရာတွင် သက်ဆိုင်ရာ အတန်းအလိုက် သတ်မှတ်ထားသော စနစ်အတိုင်း တွက်ချက်ပေးမည်
