<div class="app-wrapper-footer">
    <div class="app-footer">
       <div class="app-footer__inner">
          <div class="app-footer-left">
             <ul class="nav">
                <li class="nav-item">
                   <a href="javascript:void(0);" class="nav-link">
                   {{ getConfig('config_right_footer_1') ?? 'Footer Link 1' }}
                   </a>
                </li>
                <li class="nav-item">
                   <a href="javascript:void(0);" class="nav-link">
                   {{ getConfig('config_right_footer_2') ?? 'Footer Link 2' }}
                   </a>
                </li>
             </ul>
          </div>
          <div class="app-footer-right">
             <ul class="nav">
                <li class="nav-item">
                   <a href="javascript:void(0);" class="nav-link">
                   {{ getConfig('config_left_footer_1') ?? 'Footer Link 3' }}
                   </a>
                </li>
                <li class="nav-item">
                   <a href="javascript:void(0);" class="nav-link">
                      {{ getConfig('config_left_footer_2') ?? 'Footer Link 4' }}
                   </a>
                </li>
             </ul>
          </div>
       </div>
    </div>
 </div>