<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Customer;
use App\Models\Image;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Subject::create([
            'subject' => 'Cán bộ công chức viên chức Nhà nước'
        ]);

        Subject::create([
            'subject' => 'Nhân viên văn phòng (nhận lương chuyển khoản)'
        ]);

        Subject::create([
            'subject' => 'Sở hữu Hợp đồng Bảo hiểm Nhân thọ hoặc Đăng ký Xe máy'
        ]);

        Subject::create([
            'subject' => 'Khác (lương tiền mặt, kinh doanh tự do,…)'
        ]);

        // User::factory(10)->create();

       //  User::factory()->create([
//             'name' => 'Administrator',
//             'email' => 'administrator@example.com',
//             'password' => Hash::make('admin@009813'),
//             'role' => 'ADMIN'
//         ]);
//         Setting::insert([
//             'id' => 1,
//             'title' => "LFVN Loan",
//             'logo' => "/ladi/logo_lfv-02-1-20240318105626-r4kfp.png",
//             'background' => "/ladi/kv-vay-nhanh-lai-canh-tranh-1000x310-1-20240318111907-iu7ag.png",
//             'mb_background' => "/ladi/1-20240318105903-ybtkr.png",
//             'pc_banner' => "/ladi/20240312065156-se_kq_07072024.png",
//             'mobile_banner' => "/ladi/mb_banner.jpg",
//             'popup' => true,
//             'popup_image' => "/ladi/20240312065954-bf3ks.png",
//             'detail_link' => "https://www.lottefinance.vn/images/resources/file/Tnc CTKM Hoàn 50 tiền lãi kỳ đầu p2.pdf",
//             'rate' => 18,
//             'about1' => 'Với phương châm “Gia tăng giá trị, nâng tầm cuộc sống”, chúng tôi đồng hành cùng khách hàng trong mọi nhu cầu tài chính hàng ngày như cho vay tiêu dùng tín chấp, cho vay mua ô tô, dịch vụ mua trước trả sau, phát hành thẻ tín dụng,…',
//             'about2' => 'LOTTE Finance luôn nỗ lực đi đầu thị trường về sự minh bạch trong giao dịch tài chính, nhằm cung cấp những sản phẩm, dịch vụ uy tín tới khách hàng và góp phần đẩy lùi tín dụng đen tại Việt Nam.',
//             'about_image' => "/ladi/c8b000ef-1-20240216094817-wjf-r.png",
//             'logo_footer' => "/ladi/logo_lfv-05-20240318105642-j_u2f.png"
//         ]);

//         Image::insert([
//             'filename' => 'logo_lfv-05-20240318105642-j_u2f.png',
//             'type' => 'logo_footer',
//             'file' => "/ladi/logo_lfv-05-20240318105642-j_u2f.png",
//         ]);

//         Image::insert([
//             'filename' => 'c8b000ef-1-20240216094817-wjf-r.png',
//             'type' => 'about',
//             'file' => "/ladi/c8b000ef-1-20240216094817-wjf-r.png",
//         ]);

//         Image::insert([
//             'filename' => 'logo_lfv-02-1-20240318105626-r4kfp.png',
//             'type' => 'logo',
//             'file' => "/ladi/logo_lfv-02-1-20240318105626-r4kfp.png",
//         ]);

//         Image::insert([
//             'filename' => 'kv-vay-nhanh-lai-canh-tranh-1000x310-1-20240318111907-iu7ag.png',
//             'type' => 'background',
//             'file' => "/ladi/kv-vay-nhanh-lai-canh-tranh-1000x310-1-20240318111907-iu7ag.png",
//         ]);

//         Image::insert([
//             'filename' => '20240312065156-se_kq_07072024.png',
//             'type' => 'pc_banner',
//             'file' => "/ladi/20240312065156-se_kq_07072024.png",
//         ]);

//         Image::insert([
//             'filename' => 'mb_banner.jpg',
//             'type' => 'mobile_banner',
//             'file' => "/ladi/mb_banner.jpg",
//         ]);

//         Image::insert([
//             'filename' => '20240312065954-bf3ks.png',
//             'type' => 'popup',
//             'file' => "/ladi/20240312065954-bf3ks.png",
//         ]);

//         Image::insert([
//             'filename' => '1-20240318105903-ybtkr.png',
//             'type' => 'mb_background',
//             'file' => "/ladi/1-20240318105903-ybtkr.png",
//         ]);

//         Sale::insert([
//             'title' => "Cho vay khách hàng<br>có nguồn thu nhập từ lương",
//             'content' => "Khách hàng là công nhân, đang làm việc chính thức tại các công ty với thu nhập chỉ từ 4 triệu đồng đã có thể vay với lãi suất hấp dẫn",
//             'image' => "/ladi/frame-144-20240216094827-tcpch.png",
//             'loan' => "100 triệu",
//             'rate' => 0.83,
//             'period' => "tháng",
//             'status' => true
//         ]);

//         Image::insert([
//             'filename' => 'frame-144-20240216094827-tcpch.png',
//             'type' => 'sale',
//             'file' => "/ladi/frame-144-20240216094827-tcpch.png",
//         ]);

//         Sale::insert([
//             'title' => "Cho vay khách hàng là cán bộ công chức, viên chức",
//             'content' => "Dành cho Khách hàng là cán bộ, công chức, viên chức.... Nhà nước với thu nhập chỉ từ 3 triệu đồng",
//             'image' => "/ladi/frame-152-20240216094827-b2ih5.png",
//             'loan' => "300 triệu",
//             'rate' => 0.98,
//             'period' => "tháng",
//             'status' => true
//         ]);

//         Image::insert([
//             'filename' => 'frame-152-20240216094827-b2ih5.png',
//             'type' => 'sale',
//             'file' => "/ladi/frame-152-20240216094827-b2ih5.png",
//         ]);

//         Sale::insert([
//             'title' => "Cho vay khách hàng là phụ nữ",
//             'content' => "Chỉ cần có thu nhập từ 3 triệu đồng, khách hàng/ chồng khách hàng sở hữu đăng ký xe máy có thể vay với lãi suất ưu đãi",
//             'image' => "/ladi/frame-157-20240216094828-x_045.png",
//             'loan' => "50 triệu",
//             'rate' => 2.09,
//             'period' => "tháng",
//             'status' => true
//         ]);

//         Image::insert([
//             'filename' => 'frame-157-20240216094828-x_045.png',
//             'type' => 'sale',
//             'file' => "/ladi/frame-157-20240216094828-x_045.png",
//         ]);

//         Sale::insert([
//             'title' => "Cho vay khách hàng<br>có hợp đồng bảo hiểm nhân thọ",
//             'content' => "Dành cho Khách hàng hoặc vợ/chồng KH có hợp đồng bảo hiểm nhân thọ, đóng phí từ 5 triệu đồng/năm với thủ tục đơn giản, nhanh chóng",
//             'image' => "/ladi/frame-154-20240216094828-6s5c1.png",
//             'loan' => "100 triệu",
//             'rate' => 1.92,
//             'period' => "tháng",
//             'status' => true
//         ]);

//         Image::insert([
//             'filename' => 'frame-154-20240216094828-6s5c1.png',
//             'type' => 'sale',
//             'file' => "/ladi/frame-154-20240216094828-6s5c1.png",
//         ]);

//         Sale::insert([
//             'title' => "Cho vay khách hàng có lịch sử vay tại các tổ chức tín dụng&nbsp;",
//             'content' => "Giải ngân trực tiếp, thủ tục nhanh gọn cho Khách hàng có khoản vay và lịch sử trả nợ tốt tại Công ty tài chính khác hoặc Ngân hàng, và thu nhập chỉ từ 3 triệu đồng",
//             'image' => "/ladi/frame-156-20240216094828-qgshl.png",
//             'loan' => "100 triệu",
//             'rate' => 1.98,
//             'period' => "tháng",
//             'status' => true
//         ]);

//         Image::insert([
//             'filename' => 'frame-156-20240216094828-qgshl.png',
//             'type' => 'sale',
//             'file' => "/ladi/frame-156-20240216094828-qgshl.png",
//         ]);

//         Sale::insert([
//             'title' => "Cho vay khách hàng<br>là chủ kinh doanh",
//             'content' => "Chỉ cần cung cấp sao kê ngân hàng, Khách hàng là chủ hộ kinh doanh, chủ doanh nghiệp, kinh doanh online có thể được hỗ trợ khoản vay nhanh chóng, chớp cơ hội kinh doanh",
//             'image' => "/ladi/frame-151-20240216094827-kw_bs.png",
//             'loan' => "40 triệu",
//             'rate' => 1.83,
//             'period' => "tháng",
//             'status' => true
//         ]);

//         Image::insert([
//             'filename' => 'frame-151-20240216094827-kw_bs.png',
//             'type' => 'sale',
//             'file' => "/ladi/frame-151-20240216094827-kw_bs.png",
//         ]);

//         Customer::insert([
//             'name' => "Chị Vân Anh",
//             'career' => "Giáo viên",
//             'content' => "Nhờ LOTTE Finance tôi có thể cân đối các nhu cầu mua sắm hàng ngày và chủ động chi trả cho các tình huống khẩn cấp",
//             'image' => "/ladi/ellipse-13-20240216094817-ng_-k.png"
//         ]);

//         Image::insert([
//             'filename' => 'ellipse-13-20240216094817-ng_-k.png',
//             'type' => 'customer',
//             'file' => "/ladi/ellipse-13-20240216094817-ng_-k.png",
//         ]);

//         Customer::insert([
//             'name' => "Chị Hồng Anh",
//             'career' => "Nội trợ",
//             'content' => "Là người có 2 con nhỏ, chi phí ăn học cho các con hàng tháng với tôi rất lớn. LOTTE Finance đã giúp tôi có một khoản tiền dự phòng để yên tâm chăm lo cho các con",
//             'image' => "/ladi/1-20240216094817-2_rf5.png"
//         ]);

//         Image::insert([
//             'filename' => '1-20240216094817-2_rf5.png',
//             'type' => 'customer',
//             'file' => "/ladi/1-20240216094817-2_rf5.png",
//         ]);

//         Customer::insert([
//             'name' => "Anh Tiến Hưng",
//             'career' => "Quản đốc phân xưởng",
//             'content' => "Tôi hoàn toàn hài lòng khi vay tại LOTTE Finance. Các thủ tục vay rất đơn giản và tôi đã nhận được tiền giải ngân nhanh chóng",
//             'image' => "/ladi/12-20240216094817-8gs2j.png"
//         ]);

//         Image::insert([
//             'filename' => '12-20240216094817-8gs2j.png',
//             'type' => 'customer',
//             'file' => "/ladi/12-20240216094817-8gs2j.png",
//         ]);

//         Customer::insert([
//             'name' => "Anh Xuân Đạt",
//             'career' => "Nhân viên văn phòng",
//             'content' => "Chính sách của bên LOTTE Finance rất tốt nên tôi yên tâm sử dụng dịch vụ của LOTTE Finance. Các bạn nhân viên tư vấn rất nhiệt tình, nhanh chóng",
//             'image' => "/ladi/ellipse-13-20240313113140-xf3hl.png"
//         ]);

//         Image::insert([
//             'filename' => 'ellipse-13-20240313113140-xf3hl.png',
//             'type' => 'customer',
//             'file' => "/ladi/ellipse-13-20240313113140-xf3hl.png",
//         ]);

//         Customer::insert([
//             'name' => "Chị Vân",
//             'career' => "Nữ y tá",
//             'content' => "Khi gia đình có khoản chi đột xuất, nhờ có khoản vay kịp thời từ LOTTE Finance, tôi và gia đình đã có thể nhanh chóng ổn định cuộc sống",
//             'image' => "/ladi/ellipse-13-1-20240313113150-rmakp.png"
//         ]);

//         Image::insert([
//             'filename' => 'ellipse-13-1-20240313113150-rmakp.png',
//             'type' => 'customer',
//             'file' => "/ladi/ellipse-13-1-20240313113150-rmakp.png",
//         ]);

//         Code::insert([
//             'id' => 1,
//             'header' => "",
//             'footer' => "",
//             'advantage' => "<div id='SECTION3' class='ladi-section'>
//       <div class='ladi-section-background'></div>
//       <div class='ladi-container'>
//         <div id='IMAGE84' class='ladi-element'>
//           <div class='ladi-image'>
//             <div class='ladi-image-background'></div>
//           </div>
//         </div>
//         <div id='GROUP5' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='HEADLINE9' class='ladi-element'>
//               <h1 class='ladi-headline ladi-transition'>Ưu điểm vượt trội</h1>
//             </div>
//             <div id='LINE1' class='ladi-element'>
//               <div class='ladi-line'>
//                 <div class='ladi-line-container'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP1' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='BOX1' class='ladi-element'>
//               <div class='ladi-box ladi-transition'></div>
//             </div>
//             <div id='IMAGE2' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//             <div id='PARAGRAPH1' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'>Duyệt vay đến<br><span style='color: rgb(231, 37, 43);'>300
//                   triệu đồng</span></div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP6' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='GROUP4' class='ladi-element'>
//               <div class='ladi-group'>
//                 <div id='BOX5' class='ladi-element'>
//                   <div class='ladi-box ladi-transition'></div>
//                 </div>
//                 <div id='PARAGRAPH4' class='ladi-element'>
//                   <div class='ladi-paragraph ladi-transition'>Lãi suất cạnh tranh *<br><span
//                       style='color: rgb(231, 37, 43);'>Chỉ từ 10 %/ năm</span></div>
//                 </div>
//               </div>
//             </div>
//             <div id='IMAGE8' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP7' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='GROUP2' class='ladi-element'>
//               <div class='ladi-group'>
//                 <div id='BOX3' class='ladi-element'>
//                   <div class='ladi-box ladi-transition'></div>
//                 </div>
//                 <div id='PARAGRAPH2' class='ladi-element'>
//                   <div class='ladi-paragraph ladi-transition'>Thủ tục <span style='color: rgb(231, 37, 43);'>minh
//                       bạch</span>,<br>giải ngân <span style='color: rgb(231, 37, 43);'>nhanh chóng</span><br></div>
//                 </div>
//               </div>
//             </div>
//             <div id='IMAGE6' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP8' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='GROUP3' class='ladi-element'>
//               <div class='ladi-group'>
//                 <div id='BOX4' class='ladi-element'>
//                   <div class='ladi-box ladi-transition'></div>
//                 </div>
//                 <div id='PARAGRAPH3' class='ladi-element'>
//                   <div class='ladi-paragraph ladi-transition'>Thời hạn cho vay đến<br><span
//                       style='color: rgb(231, 37, 43);'>60 tháng</span></div>
//                 </div>
//               </div>
//             </div>
//             <div id='IMAGE7' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//       </div>
//     </div>",
//             'procedure' => "<div id='SECTION6' class='ladi-section'>
//       <div class='ladi-section-background'></div>
//       <div class='ladi-container'>
//         <div id='GROUP12' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='HEADLINE11' class='ladi-element'>
//               <h1 class='ladi-headline ladi-transition'>Quy trình đăng ký vay</h1>
//             </div>
//             <div id='LINE3' class='ladi-element'>
//               <div class='ladi-line'>
//                 <div class='ladi-line-container'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP14' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='GROUP13' class='ladi-element'>
//               <div class='ladi-group'>
//                 <div id='BOX6' class='ladi-element'>
//                   <div class='ladi-box ladi-transition'></div>
//                 </div>
//                 <div id='PARAGRAPH5' class='ladi-element'>
//                   <div class='ladi-paragraph ladi-transition'><span style='color: rgb(231, 37, 43);'>1. Đăng ký
//                       vay</span></div>
//                 </div>
//               </div>
//             </div>
//             <div id='PARAGRAPH6' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'>Khách hàng liên hệ Hotline: 1900-6866 hoặc để lại thông tin
//                 trên website, app để được tư vấn miễn phí</div>
//             </div>
//             <div id='IMAGE22' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP23' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='GROUP15' class='ladi-element'>
//               <div class='ladi-group'>
//                 <div id='GROUP16' class='ladi-element'>
//                   <div class='ladi-group'>
//                     <div id='BOX7' class='ladi-element'>
//                       <div class='ladi-box ladi-transition'></div>
//                     </div>
//                     <div id='PARAGRAPH8' class='ladi-element'>
//                       <div class='ladi-paragraph ladi-transition'>2. Nộp hồ sơ vay</div>
//                     </div>
//                   </div>
//                 </div>
//                 <div id='PARAGRAPH9' class='ladi-element'>
//                   <div class='ladi-paragraph ladi-transition'>Sau khi được nhân viên của LOTTE Finance tư vấn về sản
//                     phẩm, Khách hàng chọn khoản vay phù hợp và nộp hồ sơ trực tiếp hoặc online</div>
//                 </div>
//               </div>
//             </div>
//             <div id='IMAGE26' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP21' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='GROUP19' class='ladi-element'>
//               <div class='ladi-group'>
//                 <div id='GROUP20' class='ladi-element'>
//                   <div class='ladi-group'>
//                     <div id='BOX9' class='ladi-element'>
//                       <div class='ladi-box ladi-transition'></div>
//                     </div>
//                     <div id='PARAGRAPH12' class='ladi-element'>
//                       <div class='ladi-paragraph ladi-transition'>4. Nhận giải ngân</div>
//                     </div>
//                   </div>
//                 </div>
//                 <div id='PARAGRAPH13' class='ladi-element'>
//                   <div class='ladi-paragraph ladi-transition'>Sau khi ký hợp đồng vay, Khách hàng nhận tiền trực tiếp
//                     qua tài khoản ngân hàng hoặc tại điểm giao dịch từ đối tác của LOTTE Finance như VNPost,
//                     Vietinbank,….<br></div>
//                 </div>
//               </div>
//             </div>
//             <div id='IMAGE27' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP22' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='GROUP17' class='ladi-element'>
//               <div class='ladi-group'>
//                 <div id='GROUP18' class='ladi-element'>
//                   <div class='ladi-group'>
//                     <div id='BOX8' class='ladi-element'>
//                       <div class='ladi-box ladi-transition'></div>
//                     </div>
//                     <div id='PARAGRAPH10' class='ladi-element'>
//                       <div class='ladi-paragraph ladi-transition'>3. Thẩm định &amp; phê duyệt hồ sơ</div>
//                     </div>
//                   </div>
//                 </div>
//                 <div id='PARAGRAPH11' class='ladi-element'>
//                   <div class='ladi-paragraph ladi-transition'>Dựa trên hồ sơ Khách hàng cung cấp, LOTTE Finance sẽ thẩm
//                     định và gửi đến Khách hàng kết quả phê duyệt</div>
//                 </div>
//               </div>
//             </div>
//             <div id='IMAGE28' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//           </div>
//         </div>
//         <div data-action='true' id='GROUP203' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='BUTTON46' class='ladi-element'>
//               <div class='ladi-button ladi-transition'>
//                 <div class='ladi-button-background'></div>
//                 <div id='BUTTON_TEXT46' class='ladi-element ladi-button-headline'>
//                   <p class='ladi-headline ladi-transition'>Đăng ký ngay&nbsp; &nbsp;</p>
//                 </div>
//               </div>
//             </div>
//             <div id='SHAPE21' class='ladi-element'>
//               <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//                   preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#FFFFFF'>
//                   <use xlink:href='#shape_JPJeNRfroa'></use>
//                 </svg></div>
//             </div>
//           </div>
//         </div>
//       </div>
//     </div>",
//             'question' => "<div id='SECTION11' class='ladi-section'>
//       <div class='ladi-section-background'></div>
//       <div class='ladi-container'>
//         <div data-action='true' id='BUTTON9' class='ladi-element'>
//           <div class='ladi-button ladi-transition'>
//             <div class='ladi-button-background'></div>
//             <div id='BUTTON_TEXT9' class='ladi-element ladi-button-headline'>
//               <p class='ladi-headline ladi-transition'>Câu hỏi thường gặp</p>
//             </div>
//           </div>
//         </div>
//         <div data-action='true' id='GROUP89' class='ladi-element'>
//           <div class='ladi-group'><a href='tel:0911083128' id='GROUP87' class='ladi-element' title='Hotline đăng ký vay'>
//               <div class='ladi-group'>
//                 <div id='PARA73' class='ladi-element' style='text-align: center; top: -43px; font-weight: bold;'>
//                   <h1>Hotline <br> đăng ký vay</h1>
//                 </div>
//                 <div id='IMAGE73' class='ladi-element'>
//                   <div class='ladi-image'>
//                     <div class='ladi-image-background'></div>
//                   </div>
//                 </div>
//                 <div id='IMAGE75' class='ladi-element'>
//                   <div class='ladi-image'>
//                     <div class='ladi-image-background'></div>
//                   </div>
//                 </div>
//               </div>
//             </a><a href='https://m.me/LOTTEFinanceVietnam?locale=vi_VN' target='_blank' id='GROUP88'
//               class='ladi-element'>
//               <div class='ladi-group'>
//                 <div id='IMAGE72' class='ladi-element'>
//                   <div class='ladi-image'>
//                     <div class='ladi-image-background'></div>
//                   </div>
//                 </div>
//                 <div id='IMAGE74' class='ladi-element'>
//                   <div class='ladi-image'>
//                     <div class='ladi-image-background'></div>
//                   </div>
//                 </div>
//               </div>
//             </a></div>
//         </div>
//         <div id='IMAGE107' class='ladi-element'>
//           <div class='ladi-image'>
//             <div class='ladi-image-background'></div>
//           </div>
//         </div>
//         <div id='LINE73' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//         <div id='LINE71' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//         <div id='LINE69' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//         <div id='GROUP154' class='ladi-element'>
//           <div class='ladi-group'>
//             <div data-action='true' id='PARAGRAPH143' class='ladi-element'>
//               <div class='ladi-paragraph'>Lịch sử tín dụng của tôi sẽ bị ảnh hưởng như thế nào khi Khoản Vay bị quá hạn
//                 thanh toán?</div>
//             </div>
//             <div id='PARAGRAPH144' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'><span style='font-style: italic;'>Tùy theo số ngày quá hạn
//                   thanh toán khoản vay mà LFVN sẽ phân loại các nhóm nợ tín dụng khác nhau theo quy định nợ của Ngân
//                   hàng Nhà nước và báo cáo về trung tâm CIC. Đồng thời LFVN sẽ áp dụng lãi chậm trả theo quy định của
//                   hợp đồng tín dụng.</span><br></div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP151' class='ladi-element'>
//           <div class='ladi-group'>
//             <div data-action='true' id='PARAGRAPH137' class='ladi-element'>
//               <div class='ladi-paragraph'>Khoản trả góp của tôi sẽ được tính như thế nào?</div>
//             </div>
//             <div id='PARAGRAPH138' class='ladi-element'>
//               <div class='ladi-paragraph'><span style='font-style: italic;'>Khoản thanh toán đều hàng tháng, trong đó
//                   lãi suất được tính trên cơ sở dư nợ giảm dần và số tiền gốc phải trả được điều chỉnh để đảm bảo khoản
//                   thanh toán đều vào mỗi tháng (ngoại trừ kỳ đầu và kỳ cuối, số tiền phải trả hàng tháng có thể
//                   khác).</span><br></div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP150' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='PARAGRAPH135' class='ladi-element'>
//               <div class='ladi-paragraph'>Ngoài lãi phải trả đều đặn, khi vay tại LOTTE Finance tôi còn phải trả những
//                 loại phí nào?</div>
//             </div>
//             <div id='PARAGRAPH136' class='ladi-element'>
//               <div class='ladi-paragraph'><span style='font-style: italic;'>LOTTE Finance (LFVN) hỗ trợ làm thủ tục, hồ
//                   sơ vay hoàn toàn miễn phí cho khách hàng (KH). Dù hồ sơ được duyệt vay hay không, Quý khách không phải
//                   đóng bất kỳ chi phí nào trước khi ký hợp đồng vay.</span><br></div>
//             </div>
//           </div>
//         </div>
//         <div id='LINE76' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//         <div id='LINE75' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//         <div id='LINE74' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//         <div id='LINE72' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//         <div id='GROUP156' class='ladi-element'>
//           <div class='ladi-group'>
//             <div data-action='true' id='PARAGRAPH147' class='ladi-element'>
//               <div class='ladi-paragraph'>Trường hợp tôi muốn thanh toán trước hạn thì phải làm thế nào?</div>
//             </div>
//             <div id='PARAGRAPH148' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'><span style='font-style: italic;'>KH lưu ý chỉ được tất toán
//                   trước hạn toàn bộ khoản vay không được tất toán trước hạn một phần
//                   <br></span>KH vui lòng liên hệ số hotline 0911 083 128 bằng số điện thoại Bên vay đã đăng ký để có
//                 thông
//                 tin về số tiền cũng như cách thức thanh toán. Khoản vay cũng có thể được hệ thống tự động tất toán trước
//                 hạn khi KH nộp đủ số tiền cần thiết cho LOTTE Finance.<br></div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP155' class='ladi-element'>
//           <div class='ladi-group'>
//             <div data-action='true' id='PARAGRAPH145' class='ladi-element'>
//               <div class='ladi-paragraph'>Thời gian giải ngân khoản vay mất bao lâu?</div>
//             </div>
//             <div id='PARAGRAPH146' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'><span style='font-style: italic;'>Tùy vào gói vay KH lựa chọn
//                   mà có thời gian thẩm định và duyệt hồ sơ vay khác nhau. Kể từ thời điểm KH cung cấp đủ hồ sơ, khoản
//                   vay sẽ được giải ngân chỉ từ 4 giờ.</span><br></div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP153' class='ladi-element'>
//           <div class='ladi-group'>
//             <div data-action='true' id='PARAGRAPH141' class='ladi-element'>
//               <div class='ladi-paragraph'>Thời hạn vay tối đa có thể áp dụng cho tôi là bao lâu?</div>
//             </div>
//             <div id='PARAGRAPH142' class='ladi-element'>
//               <div class='ladi-paragraph'><span style='font-style: italic;'>Thời hạn vay linh hoạt theo từng sản phẩm và
//                   nhu cầu của KH, tối thiểu 06 tháng - tối đa 48 tháng. Tuy nhiên, thời hạn vay còn phụ thuộc vào độ
//                   tuổi lao động của KH, trong đó độ tuổi tối đa kết thúc hợp đồng vay là 60-65 tuổi.</span><br></div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP152' class='ladi-element'>
//           <div class='ladi-group'>
//             <div data-action='true' id='PARAGRAPH139' class='ladi-element'>
//               <div class='ladi-paragraph'>Số tiền tối đa tôi có thể vay là bao nhiêu?</div>
//             </div>
//             <div id='PARAGRAPH140' class='ladi-element'>
//               <div class='ladi-paragraph'><span style='font-style: italic;'>KH được xem xét theo từng sản phẩm KH đăng
//                   kí. LFVN đang hỗ trợ vay lên đến 300 triệu. Để biết thêm chi tiết, KH vui lòng liên hệ tổng đài 0911
//                   083 128</span><br></div>
//             </div>
//           </div>
//         </div>
//         <div id='GROUP157' class='ladi-element'>
//           <div class='ladi-group'>
//             <div data-action='true' id='PARAGRAPH149' class='ladi-element'>
//               <div class='ladi-paragraph'>Bảo hiểm khoản vay là gì? Có bắt buộc mua bảo hiểm khi ký hợp đồng vay hay
//                 không?</div>
//             </div>
//             <div id='PARAGRAPH150' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'><span style='font-style: italic;'>Bảo hiểm khoản vay là số
//                   tiền mà khách hàng chi trả để mua bảo hiểm cho hợp đồng vay của mình. Khi khách hàng mua bảo hiểm,
//                   trong trường hợp khách hàng không may gặp phải những rủi ro không lường trước được sau khi vay tín
//                   chấp, khiến khách hàng mất khả năng thanh toán, thì công ty bảo hiểm sẽ trả nợ thay khách hàng. Bảo
//                   hiểm khoản vay không chỉ bảo vệ khách hàng và gia đình trước các rủi ro, mà còn là một tiêu chí giúp
//                   khoản vay của khách hàng dễ dàng được duyệt hơn. Bảo hiểm khoản vay là chi phí không bắt buộc khi ký
//                   hợp đồng vay, khách hàng có quyền lựa chọn việc mua hoặc không mua bảo hiểm.</span><br></div>
//             </div>
//           </div>
//         </div>
//         <div id='LINE96' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//         <div id='SHAPE30' class='ladi-element'>
//           <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//               preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#000'>
//               <use xlink:href='#shape_EuvqYgIJeu'></use>
//             </svg></div>
//         </div>
//         <div id='SHAPE31' class='ladi-element'>
//           <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//               preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#000'>
//               <use xlink:href='#shape_EuvqYgIJeu'></use>
//             </svg></div>
//         </div>
//         <div id='SHAPE32' class='ladi-element'>
//           <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//               preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#000'>
//               <use xlink:href='#shape_EuvqYgIJeu'></use>
//             </svg></div>
//         </div>
//         <div id='SHAPE33' class='ladi-element'>
//           <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//               preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#000'>
//               <use xlink:href='#shape_EuvqYgIJeu'></use>
//             </svg></div>
//         </div>
//         <div id='SHAPE34' class='ladi-element'>
//           <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//               preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#000'>
//               <use xlink:href='#shape_EuvqYgIJeu'></use>
//             </svg></div>
//         </div>
//         <div id='SHAPE35' class='ladi-element'>
//           <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//               preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#000'>
//               <use xlink:href='#shape_EuvqYgIJeu'></use>
//             </svg></div>
//         </div>
//         <div id='SHAPE36' class='ladi-element'>
//           <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//               preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#000'>
//               <use xlink:href='#shape_EuvqYgIJeu'></use>
//             </svg></div>
//         </div>
//         <div id='SHAPE37' class='ladi-element'>
//           <div class='ladi-shape'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'
//               preserveAspectRatio='none' viewBox='0 0 24 24' class='' fill='#000'>
//               <use xlink:href='#shape_EuvqYgIJeu'></use>
//             </svg></div>
//         </div>
//       </div>
//     </div>",
//             'about_footer' => "<div id='SECTION27' class='ladi-section'>
//     <div class='ladi-section-background'></div>
//       <div class='ladi-container'>
//         <div id='IMAGE141' class='ladi-element'>
//           <div class='ladi-image'>
//             <div class='ladi-image-background'></div>
//           </div>
//         </div>
//         <div data-action='true' id='GROUP161' class='ladi-element'>
//           <div class='ladi-group'>
//             <div id='IMAGE131' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div>
//             <div id='PARAGRAPH163' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'>0911 083 128<br><br>1900 6866 #1<br><br>Tầng 12A Tháp Tây, LOTTE Center, 54 Liễu
//                 Giai, Phường Cống Vị, Quận Ba Đình, Thành phố Hà Nội, Việt Nam.<br><br>www.lottefinance.vn<br></div>
//             </div>
//             <div id='PARAGRAPH164' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'><span style='font-weight: bold;'>Đăng ký khoản vay: <br><br>Chăm sóc khách hàng:<br><br>Địa
//                   chỉ:<br><br><br>Website:</span><br></div>
//             </div>
//             <div id='LINE90' class='ladi-element'>
//               <div class='ladi-line'>
//                 <div class='ladi-line-container'></div>
//               </div>
//             </div>
//             <div id='LINE91' class='ladi-element'>
//               <div class='ladi-line'>
//                 <div class='ladi-line-container'></div>
//               </div>
//             </div>
//             <div id='PARAGRAPH165' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'><span style='font-weight: 700;'>Khám phá LOTTE Finance
//                   Mobile:</span><br></div>
//             </div>
//             <div id='IMAGE132' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </div><a
//               href='https://play.google.com/store/apps/details?id=com.lotte.finance.vietnam&fbclid=IwAR3Yg_BuIAXg_PcjNdk8L2Xqi5hjNmOr_GLA-XKRI5GgiZ3LB3ehLvXevxQ'
//               target='_blank' id='IMAGE133' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </a><a
//               href='https://play.google.com/store/apps/details?id=com.lotte.finance.vietnam&fbclid=IwAR3Yg_BuIAXg_PcjNdk8L2Xqi5hjNmOr_GLA-XKRI5GgiZ3LB3ehLvXevxQ'
//               target='_blank' id='IMAGE134' class='ladi-element'>
//               <div class='ladi-image'>
//                 <div class='ladi-image-background'></div>
//               </div>
//             </a>
//             <div id='PARAGRAPH166' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'>© 2024 Bản quyền thuộc về LOTTE FINANCE</div>
//             </div>
//             <div id='PARAGRAPH167' class='ladi-element'>
//               <div class='ladi-paragraph ladi-transition'>Đơn vị chủ quản: Công ty Tài chính TNHH MTV LOTTE Việt Nam
//                 (LOTTE Finance).
//                 Địa chỉ: Tầng 12A, Tòa Tây, LOTTE Center Hanoi, 54 Liễu Giai, Ba Đình, Hà Nội, Hotline: 1900 6866.
//                 <br>Mã số doanh nghiệp: 0103172804 do Sở Kế hoạch và Đầu tư Thành phố Hà Nội cấp ngày 31/12/2008
//               </div>
//             </div>
//           </div>
//         </div>
//         <div id='LINE97' class='ladi-element'>
//           <div class='ladi-line'>
//             <div class='ladi-line-container'></div>
//           </div>
//         </div>
//       </div>
//     </div>"
//         ]);
    }
}
