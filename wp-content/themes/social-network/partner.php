<?php
/**
 * Template Name: Partner
 */
get_header();
?>
    <div class="container my-5 shadow p-5">
        <div class="page-title"><h2 class="entry-title">PARTNER INTERFACE</h2></div>
        <div class="partner-nav mb-4">
            <ul class="partner-menu d-flex align-items-center justify-content-between">
                <li id="answers-on-questions" class="partner-item active">
                    <i class="far fa-question-circle"></i>
                    <span class="partner-title">Answers on questions</span>
                </li>
                <li id="my-bids" class="partner-item">
                    <i class="far fa-file-alt"></i>
                    <span class="partner-title">My bids</span>
                </li>
                <li id="accounts-upload" class="partner-item">
                    <i class="fas fa-upload"></i>
                    <span class="partner-title">Accounts upload</span>
                </li>
                <li id="profile-settings" class="partner-item">
                    <i class="far fa-credit-card"></i>
                    <span class="partner-title">Profile settings</span>
                </li>
                <li id="sign-out" class="partner-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="partner-title">Sign out</span>
                </li>
            </ul>
        </div>
        <div class="sub-menu mb-4">
            <div class="button-wrapper">
                <a href="#" class="btn" id="current-bid-button">Current bids requests</a>
                <a href="#" class="btn active" id="add-bid-button">Add new bid</a>
            </div>
        </div>
        <div class="partner-content-section mb-4 bg-white p-2">
            <div class="content-title">
                <h2 class="title">ACCOUNT DELIVERY APPLICATION</h2>
            </div>
            <div class="partner-table-section mb-4">
                <table class="partner-table">
                    <thead>
                    <tr class="table-header">
                        <th>
                            <i class="far fa-question-circle"></i>
                            <span class="data-table-header-text">Accounts category *</span></th>
                        <th>
                            <i class="far fa-question-circle"></i>
                            <span class="data-table-header-text">Description *</span></th>
                        <th>
                            <i class="far fa-question-circle"></i>
                            <span class="data-table-header-text">Registration country (IP) *</span></th>
                        <th>
                            <i class="far fa-question-circle"></i>
                            <span class="data-table-header-text">Accounts format * </span>
                        </th>
                        <th>
                            <i class="far fa-question-circle"></i>
                            <span class="data-table-header-text">Scope of supply, pcs. *</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="mobile-head">
                                <i class="far fa-question-circle"></i>
                                <span class="data-table-header-text">Accounts category *</span>
                            </div>
                            <select class="form-control">
                                <?php
                                $cats = get_categories(array('taxonomy' => 'product_cat', 'parent' => 0));
                                foreach ($cats as $cat) {
                                    echo '<option value="' . $cat->name . '">' . $cat->name . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <div class="mobile-head">
                                <i class="far fa-question-circle"></i>
                                <span class="data-table-header-text">Description *</span>
                            </div>
                            <textarea class="form-control">description</textarea>
                        </td>
                        <td>
                            <div class="mobile-head">
                                <i class="far fa-question-circle"></i>
                                <span class="data-table-header-text">Registration country (IP) *</span>
                            </div>
                            <textarea class="form-control">IP</textarea>
                        </td>
                        <td>
                            <div class="mobile-head">
                                <i class="far fa-question-circle"></i>
                                <span class="data-table-header-text">Accounts format * </span>
                            </div>
                            <textarea class="form-control">Account</textarea>
                        </td>
                        <td>
                            <div class="mobile-head">
                                <i class="far fa-question-circle"></i>
                                <span class="data-table-header-text">Scope of supply, pcs. *</span>
                            </div>
                            <label class="d-flex align-items-center">
                                <input style="max-width: 100px; margin-right: 15px" type="text" class="form-control"
                                       value="pcs">per day
                            </label>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="add-new-section mb-4">
                <a href="#" class="btn" id="new-line-row">add new line +</a>
            </div>
            <div class="partner-footer mb-4 p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                        <div class="partner-description">
                            <h2 class="title">WHAT WILL HAPPEN AFTER REGISTRATION?</h2>
                            <ul class="description-list">
                                <li class="list-item">
                                    <p class="list-text">Lorem Ipsum is simply dummy text of the printing </p>
                                </li>
                                <li class="list-item">
                                    <p class="list-text">Lorem Ipsum is simply dummy text of the printing </p>
                                </li>
                                <li class="list-item">
                                    <p class="list-text">Lorem Ipsum is simply dummy text of the printing </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4 d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="partner-submit-section mb-2">
                            <a href="#" id="partner-submit-button">Sent </a>
                        </div>
                        <div class="required-text">
                            <p><span class="text-danger">*</span> - All fields is required</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();