 

-- جدول المستخدمين  
CREATE TABLE admin (
  id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password text NOT NULL,
  remember_token text DEFAULT NULL,
  image varchar(255) NOT NULL,
  role int(11) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  deleted_at datetime DEFAULT NULL
) ;

 
-- جدول اشعارات المستخدمين
CREATE TABLE admin_notification (
  id int(11) NOT NULL,
  owner_id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  order_id int(11) NOT NULL,
  message text NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL
) ;


-- جدول الكوبونات المستخدمة لعمل استعراض الكوبونات بحسب رقم الحركه
CREATE TABLE applying_coupon (
  id int(11) NOT NULL,
  coupon_id int(11) NOT NULL,  
  order_id int(11) NOT NULL,  
  amount int(11) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_ timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL
) ;

-- جدول المدن
CREATE TABLE cities (
  id int(10) UNSIGNED NOT NULL,
  name varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  country_code varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  country_id int(11) DEFAULT NULL,
  district varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
)  ;

-- جدول الدول
CREATE TABLE countries (
  id int(10) UNSIGNED NOT NULL,
  code varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  name varchar(52) COLLATE utf8mb4_unicode_ci NOT NULL,
  continent enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  government_form varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  head_of_state varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  code2 varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  status int(11) NOT NULL DEFAULT 1
)  ;
 

-- جدول تعريف الكوبونات
CREATE TABLE coupon (
  id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  code varchar(255) NOT NULL,
  type varchar(50) NOT NULL,
  discount int(11) NOT NULL,
  max_use int(11) NOT NULL,
  start_date varchar(50) NOT NULL,
  end_date varchar(50) NOT NULL,
  use_count int(11) NOT NULL,
  status int(11) NOT NULL,
  total_apply float DEFAULT NULL COMMENT 'المجموع الاجمالي الذي يقبل ان يطبق عليه كود الخصم',
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  deleted_at datetime DEFAULT NULL
) ;

 

-- جدول حسابات العملاء
CREATE TABLE customer_payment (
  id int(11) NOT NULL,
  seq_no int(11) NOT NULL,
  seq_type int(11) NOT NULL,
  customer_id int(11) NOT NULL,
  debit float NOT NULL COMMENT 'مدين',
  credit float NOT NULL COMMENT 'دائن',
  notes varchar(255) DEFAULT NULL,
  order_id int(11) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ;
 
-- جدول انواع الاحداث -- كحفلات الميلاد - الزواج
CREATE TABLE event_types (
  id int(11) NOT NULL,
  image varchar(255) DEFAULT NULL,
  status int(11) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  type_description varchar(255) DEFAULT NULL,
  parent int(11) NOT NULL DEFAULT 0,
  sort int(11) NOT NULL DEFAULT 0
) ;


-- جدول تعريف اللغات
CREATE TABLE language (
  id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  file varchar(255) NOT NULL,
  icon varchar(255) DEFAULT NULL,
  status int(11) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL
) ;


-- جدول الترجمه 
CREATE TABLE language_description (
  id int(11) NOT NULL,
  table_id int(11) NOT NULL,  رقم الجدول مثلا 1 انواع الاحداث
  language_id int(11) NOT NULL, رقم اللغه
  id_ref varchar(255) DEFAULT NULL,  رقم الحركه مثلا رقم 1 في جدول نوع الحدث اعياد الميلاد 
  remarks varchar(255) DEFAULT NULL,  البيان بحسب اللغه
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL
) ;

 

-- جدول تعريف الاشعارات
CREATE TABLE notification (
  id int(11) NOT NULL,
  user_id int(11) DEFAULT NULL,
  order_id int(11) DEFAULT NULL,
  title varchar(255) NOT NULL,
  message text NOT NULL,
  image varchar(255) DEFAULT NULL,
  notification_type varchar(50) DEFAULT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL
) ;

-- --------------------------------------------------------


-- جدول اشعارات ثابته يتم استدعائها
CREATE TABLE notification_template (
  id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  subject varchar(255) NOT NULL,
  mail_content text NOT NULL,
  message_content text DEFAULT NULL,
  image varchar(255) DEFAULT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  deleted_at datetime DEFAULT NULL
) ;



-- جدول الطلبات الرئيسية اجمالي المبالغ وربط العميل من ناحية الحجز بيكون بالجدول الفرعي مثلا ممكن حجز كوشات كل يوم كوشه والقاعه ل4 ايام
CREATE TABLE orders (
  id int(11) NOT NULL,
  order_no varchar(50) NOT NULL,
  customer_id int(11) NOT NULL,
  coupon_id int(11) DEFAULT NULL,
  address_id int(11) DEFAULT NULL,
  payment int(11) NOT NULL,
  date varchar(50) DEFAULT NULL,
  time varchar(50) DEFAULT NULL,
  coupon_price int(11) DEFAULT 0,
  discount int(11) DEFAULT 0,
  order_status varchar(50) NOT NULL,
  payment_status int(11) NOT NULL,
  payment_type varchar(50) NOT NULL,
  payment_token varchar(50) DEFAULT NULL,
  order_otp int(11) DEFAULT NULL,
  reject_by varchar(255) DEFAULT NULL,
  review_status int(11) NOT NULL DEFAULT 0,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL
) ;
 
-- جدول تفاصيل الطلبات من خدمات
CREATE TABLE orders_dtl (
  id int(11) NOT NULL,
  order_id varchar(50) NOT NULL,
  supp_id int(11) NOT NULL,
  service_id int(11) NOT NULL,
  invoice_date varchar(50) NOT NULL,
  from_date varchar(50) NOT NULL,
  to_date varchar(50) NOT NULL,
  price int(11) NOT NULL,
  is_vat int(11) DEFAULT 0,
  vat_price int(11) NOT NULL,
  discount int(11) DEFAULT 0,
  net_price int(11) NOT NULL,
  service_status varchar(50) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL
) ;


-- جدول تعريف حالات الطلب لمعرفة وصف كل حاله
CREATE TABLE order_status (
  id int(11) NOT NULL,
  status_name varchar(255) NOT NULL
) ;
  

-- جدول معرفة حالات كل طلب متى تم التغيير 
CREATE TABLE order_status_history (
  id int(10) UNSIGNED NOT NULL,
  order_id bigint(20) UNSIGNED NOT NULL,
  order_status_id bigint(20) UNSIGNED NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL
)  ;


-- جدول تعريف التفاصيل الاضافية للخدمات
CREATE TABLE other_detail (
  id int(11) NOT NULL,
  other_description text DEFAULT NULL,
  other_status int(11) DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ;


-- جدول ربط التفاصيل الاضافيه للخدمات بالتصنيفات 
CREATE TABLE other_detail_category (
  id int(11) NOT NULL,
  other_id int(11) NOT NULL,
  category_id int(11) NOT NULL,
  status int(11) DEFAULT 1,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ;
 
CREATE TABLE questions (
  id int(11) NOT NULL,
  q_name varchar(255) NOT NULL,
  q_type tinyint(1) NOT NULL
) ;


-- جدول تعريف الخدمات
CREATE TABLE services (
  id int(11) NOT NULL,
  name varchar(255) DEFAULT NULL,
  description text DEFAULT NULL,
  priority int(11) DEFAULT 0,
  price float NOT NULL,
  is_vat int(11) DEFAULT 1,
  vat_no varchar(255) NOT NULL,
  supp_id int(11) DEFAULT 0,
  Infants_from int(11) DEFAULT 0,
  Infants_to int(11) DEFAULT 0,
  children_from int(11) DEFAULT 0,
  children_to int(11) DEFAULT 0,
  Adults_from int(11) DEFAULT 0,
  Adults_to int(11) DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ;

 
-- جدول الاوقات الغير شاغره للخدمه
CREATE TABLE services_booking (
  id int(11) NOT NULL,
  services_id int(11) NOT NULL,
  booking_type int(11) NOT NULL,
  id_ref int(11) DEFAULT 1,
  from_date varchar(50) NOT NULL,
  to_date varchar(50) NOT NULL,
  description text DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ;

 
-- جدول ربط الخدمات بالتصنيفات
CREATE TABLE services_category (
  id int(11) NOT NULL,
  image varchar(255) DEFAULT NULL,
  status int(11) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  category_description varchar(255) DEFAULT NULL,
  parent int(11) NOT NULL DEFAULT 0,
  sort int(11) NOT NULL DEFAULT 0,
  determine_invitees int(11) NOT NULL DEFAULT 0,
  is_base int(11) NOT NULL DEFAULT 0 COMMENT 'اذا كانت القيمة 1 معناه ان هذه الفئة يتم احتساب المسافات بموجبها\r\n'
) ;


-- جدول ربط الخدمات بالتفاصيل الاضافيه للتصنيفات
CREATE TABLE services_category_other (
  id int(11) NOT NULL,
  category_id int(11) NOT NULL,
  other_id int(11) NOT NULL,
  status int(11) DEFAULT 1,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ;


-- جدول تعريف التفاصيل الاضافية للخدمات
CREATE TABLE services_detail (
  id int(11) NOT NULL,
  services_id int(11) NOT NULL,
  other_id int(11) NOT NULL,
  description text DEFAULT NULL,
  status int(11) DEFAULT 1,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ;


CREATE TABLE settings (
  id int(11) NOT NULL,
  code varchar(255) DEFAULT NULL,
  the_key varchar(255) DEFAULT NULL,
  value text DEFAULT NULL,
  status tinyint(4) NOT NULL DEFAULT 1,
  created_at datetime DEFAULT NULL,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL
) ;


-- جدول تعريف ملاك الخدمات
CREATE TABLE suppliers (
  id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  location varchar(255) DEFAULT NULL,
  phone varchar(50) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  website varchar(255) DEFAULT NULL,
  description varchar(255) DEFAULT NULL,
  logo varchar(50) NOT NULL,
  favicon varchar(50) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  balance float DEFAULT 0
) ;


-- جدول حسابات ملاك الخدمات
CREATE TABLE supplier_payment (
  id int(11) NOT NULL,
  seq_no int(11) NOT NULL,
  seq_type int(11) NOT NULL,
  supplier_id int(11) NOT NULL,
  debit float NOT NULL COMMENT 'مدين',
  credit float NOT NULL COMMENT 'دائن',
  notes varchar(255) DEFAULT NULL,
  order_id int(11) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ;


-- جدول تعريف اعدادات جداول الترجمه
CREATE TABLE table_language (
  id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  table_description varchar(255) NOT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL
) ;
 
INSERT INTO table_language (id, name, table_description, created_at, updated_at) VALUES
(1, 'event_types', 'نوع الحدث', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'services_category', 'التصنيفات او الفئات', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'services', 'الخدمات', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'order_status', 'حالات الطلب', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'other_detail', 'تفاصيل اضافية للخدمات', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


-- جدول تعريف العملاء
CREATE TABLE users (
  id int(11) NOT NULL,
  name varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  phone_code varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  phone varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  location varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  country_id int(11) NOT NULL,
  city_id int(11) NOT NULL,
  address text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  address_id int(11) DEFAULT NULL,
  email_verified_at timestamp NULL DEFAULT NULL,
  password varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  image varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'user.png',
  remember_token varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  terms_condations int(11) NOT NULL DEFAULT 0,
  verify int(11) NOT NULL DEFAULT 0,
  status int(11) NOT NULL DEFAULT 0,
  lat varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  long varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  enable_notification int(11) NOT NULL DEFAULT 0,
  enable_location int(11) NOT NULL DEFAULT 0,
  last_login timestamp NULL DEFAULT NULL,
  ip_number varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  gender tinyint(4) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at datetime DEFAULT NULL
) ;


-- جدول عناوين العملاء
CREATE TABLE user_address (
  id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  address_type varchar(255) NOT NULL,
  soc_name varchar(255) NOT NULL,
  street varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  zipcode varchar(255) NOT NULL,
  lat varchar(50) DEFAULT NULL,
  lang varchar(50) DEFAULT NULL,
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  deleted_at datetime DEFAULT NULL
) ;


-- جدول تقييمات العملاء
CREATE TABLE user_evaluations (
  id int(10) UNSIGNED NOT NULL,
  evaluated_user_id bigint(20) UNSIGNED NOT NULL,
  evaluator_user_id bigint(20) UNSIGNED NOT NULL,
  evaluation_no tinyint(1) NOT NULL DEFAULT 0,
  evaluation_text varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  type tinyint(4) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL
)  ;


-- جدول الاجابات على اسئلة التقييم 
CREATE TABLE user_question_answers (
  id int(11) NOT NULL,
  question_id int(11) NOT NULL,
  user_answer varchar(255) NOT NULL,
  user_id int(11) NOT NULL
) ;
