<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-edit fa-fw "></i>
                Forms
            <span>>
                <?=(isset($form)) ? 'Edit Form "' . $form['name'] . '"' : 'Create New Form';?>
            </span>
        </h1>
    </div>
</div>
<div class="alert alert-success fade in hide" id="msg-banner">
    <button class="close" data-dismiss="alert">
        ×
    </button>
    <i class="fa-fw fa fa-check"></i>
    <span></span>
</div>

<div class="alert alert-danger fade in hide" id="msg-error">
    <button class="close" data-dismiss="alert">
        ×
    </button>
    <i class="fa-fw fa fa-times"></i>
    <span></span>
</div>



<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- START ROW -->
    <div class="row">

        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-collapsed="false">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Form</h2>

                    <ul class="nav nav-tabs pull-right in" id="myTab">
                        <li<?=($tab == 'basic') ? ' class="active"' : '';?>>
                            <a data-toggle="tab" href="#basic"><i class="fa fa-info-circle"></i> <span class="hidden-mobile hidden-tablet">Basic Info</span></a>
                        </li>
                        <? if(isset($form)) { ?>
                        <li <?=($tab == 'fields') ? ' class="active"' : '';?>>
                            <a data-toggle="tab" href="#fields"><i class="fa fa-list-alt"></i> <span class="hidden-mobile hidden-tablet">Fields</span></a>
                        </li>
                        <?php } else{ ?>
                        <li class="disabled">
                            <a><i class="fa fa-list-alt"></i> <span class="hidden-mobile hidden-tablet">Fields</span></a>
                        </li>
                        <?php } ?>
                    </ul>

                </header>

                <!-- widget div-->
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <!-- content -->
                        <div id="myTabContent" class="tab-content">
                            <!-- new tab: API interface -->
                            <div class="tab-pane fade<?=($tab == 'basic') ? ' active in' : '';?>" id="basic">
                                <form id="form-form-basic" class="smart-form">
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-6">
                                                <label class="label">Form Name <i class="fa fa-asterisk fa-required"></i></label>
                                                <label class="input">
                                                    <input type="text" name="name" maxlength="255" value="<?=(isset($banner)) ? $banner['name'] : '';?>" />
                                                </label>
                                                <div class="note">
                                                    <strong>Max characters</strong> 255
                                                </div>
                                            </section>

                                            <? if(isset($form)) { ?>
                                            <section class="col col-6">
                                                <label class="label">Form ID</label>
                                                <label class="input">
                                                    <input type="text" maxlength="255" value="<?=$form['form_id'];?>" disabled="disabled" />
                                                </label>
                                                <div class="note">
                                                    Copy and paste <b>[form id=<?=$form['form_id'];?>]</b> to wherever you want to display the form.
                                                </div>
                                            </section>
                                            <? } ?>
                                        </div>
                                        <div class="row">
                                            <section class="col col-6">
                                                <label class="label">Email Forwarding</label>
                                                <label class="input">
                                                    <input type="text" name="email" value="<?=(isset($form)) ? $form['email'] : '';?>">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-6">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="storing" <?=(isset($form) && $form['storing']) ? 'checked' : '';?>>

                                                    <i></i>Storing submitted data on server
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>


                                    <footer>
                                        <? if(isset($form)) { ?>
                                        <input type="hidden" name="form_id" value="<?=$form['form_id'];?>" />
                                        <button type="button" id="btn-update-banner-basic" class="btn btn-primary">
                                            Update Basic Info
                                        </button>
                                        <? } else { ?>
                                        <button type="button" id="btn-create-form-basic" class="btn btn-primary">
                                            Create New Form
                                        </button>
                                        <? } ?>
                                        <button type="button" class="btn btn-default" onclick="window.history.back();">
                                            Back
                                        </button>
                                    </footer>
                                </form>
                            </div>

                            <? if(isset($form)) { ?>
                            <!-- tab: Images -->
                            <div class="tab-pane tab-padding fade <?=($tab == 'fields') ? ' active in' : '';?>" id="fields">
                                <div class="row smart-form">
                                    <div class="col col-6">
                                        <div id="build">
                                        </div><!-- build -->

                                        <div id="popover-field" class="popover fade right in"></div>
                                    </div>

                                    <div class="col col-6">
                                        <!-- Tab Field Types -->

                    <ul class="nav nav-tabs tab-respond" id="myTab">
                        <li class="active"><a href="#text" data-toggle="tab">Text</a></li>
                        <li><a href="#radioscheckboxes" data-toggle="tab">Radios / Checkboxes</a></li>
                        <li><a href="#select" data-toggle="tab">Select</a></li>
                        <li><a href="#fileupload" data-toggle="tab">File Upload</a></li>
                    </ul>

                    <div class="tab-content">

                        <!--begin textinput tab-->
                        <div class="tab-pane active" id="text">

                            <div class="component" data-type="text">
                                <label class="label">Text Input</label>
                                <label class="input">
                                    <input type="text" placeholder="Placeholder">
                                </label>
                            </div>

                            <div class="component" data-type="textarea"><!-- Textarea -->
                                <label class="label">Textarea</label>
                                <label class="textarea">
                                    <textarea class="custom-scroll" row="3"></textarea>
                                </label>
                            </div>

                        </div>
                        <!--end textinput tab-->

                        <!--begin radio tab-->
                        <div class="tab-pane" id="radioscheckboxes">
                            <!-- Multiple Radios -->
                            <div class="component" data-type="radio">
                                <div class="label">Columned Radio</div>
                                <label class="radio">
                                    <input type="radio" name="radio" checked="checked" />
                                    <i></i> Option one
                                </label>
                                <label class="radio">
                                    <input type="radio" name="radio" />
                                    <i></i> Option one
                                </label>
                            </div>

                            <!-- Multiple Radios (inline) -->
                            <div class="component" data-type="radio" data-inline="true">
                                <div class="label">Inline Radio</div>
                                <div class="inline-group">
                                    <label class="radio">
                                        <input type="radio" name="radio-inline" checked="checked" />
                                        <i></i> Option one
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="radio-inline" />
                                        <i></i> Option two
                                    </label>
                                </div>

                            </div>
                            <!-- Multiple Checkboxes -->
                            <div class="component" data-type="checkbox" data-multiple="true">
                                <div class="label">Columned Checkboxes</div>
                                <label class="checkbox">
                                    <input type="checkbox" name="checkbox" checked="checked" />
                                    <i></i> Option one
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="checkbox" />
                                    <i></i> Option one
                                </label>
                            </div>

                            <!-- Multiple Checkboxes (inline) -->
                            <div class="component" data-type="checkbox" data-multiple="true" data-inline="true">
                                <div class="label">Inline Radio</div>
                                <div class="inline-group">
                                    <label class="checkbox">
                                        <input type="checkbox" name="checkbox-inline" checked="checked" />
                                        <i></i> Option one
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="checkbox-inline" />
                                        <i></i> Option one
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--end radio tab-->

                        <!--begin select-->
                        <div class="tab-pane" id="select">
                            <!-- Select Basic -->
                            <div class="component" data-type="select">
                                <label class="label">Select One</label>
                                <label class="select">
                                    <select>
                                        <option>Option one</option>
                                        <option>Option two</option>
                                    </select>
                                    <i></i>
                                </label>
                            </div>
                            <!-- Select Multiple -->
                            <div class="component" data-type="select" data-multiple="true">
                                <label class="label">Select Multiple</label>
                                <label class="select select-multiple">
                                    <select class="custom-scroll" multiple="">
                                        <option>Option one</option>
                                        <option>Option two</option>
                                    </select>
                                </label>
                                <div class="note">
                                    <strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.
                                </div>
                            </div>
                        </div>
                        <!--end select-->

                        <!--begin button-->
                        <div class="tab-pane" id="fileupload">
                            <!-- File Button -->
                            <div class="component" data-type="file">
                                <label class="label">File Upload</label>
                                <label class="input input-file" for="file">
                                    <div class="button">
                                        <input name="file" onchange="this.parentNode.nextSibling.value = this.value" type="file">Browse
                                    </div>
                                    <input placeholder="Include some files" readonly="" type="text">

                                </label>
                            </div>
                        </div>
                        <!--end button-->
                    </div><!--end tab-content-->
                                        <!-- End Tab Field Types -->
                                    </div>
                                </div>

                            </div>
                            <?php } ?>

                        </div>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
        <!-- END COL -->
    </div>
    <!-- END ROW -->
</section>
<!-- end widget grid -->


<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
    pageSetUp();

    var pagefunction = function() {
        load_fields();
        $('.component').draggable({
            containment: '#build',
            cursor: 'move',
            helper: 'clone',
            scroll: false,
            connectToSortable: '#build',
            appendTo: '#build',
            start: function (e,ui) {
                $(ui.helper).addClass('ui-draggable-helper');
            },
            stop: function (event, ui) {
                $('.drag-icon-box').remove();
                $('#build').addClass('build-bottom-padding');
                var type = ui.helper.attr('data-type');
                var inline = ui.helper.attr('data-inline');
                var multiple = ui.helper.attr('data-multiple');
                var label = ui.helper.find('.label').html();
                var placeholder = ui.helper.find('.input').find('input').attr('placeholder');
                $.ajax({
                    type: "POST",
                    url: "<?=ajax_url();?>cms/form_ajax/add_field",
                    data: {form_id: <?=$form['form_id'];?>, type: type, inline: inline, multiple: multiple, label: label, placeholder: placeholder},
                    success: function(html) {
                        load_fields();
                    }
                })
            }
        }).mousedown(function () {});
        $('#build').sortable({
            sort: function () {},
            placeholder: 'ui-state-highlight',
            receive: function () {},
            update: function (event, ui) {
                // Update orders
                var count = 0;
                var field_orders = new Array();
                $('#build').find('.sort-index').each(function(){
                    var field_id = $(this).attr('data');
                    field_orders[count++] = JSON.stringify({ 'field_id' : field_id });
                });
                $.ajax({
                    type: "POST",
                    url: "<?=ajax_url();?>cms/form_ajax/update_field_orders",
                    data: { field_orders: field_orders},
                    success: function(html) { }
                })
            },
            over:function(){
                removeItem = false;
            },
            out: function () {
                removeItem = true;
            },
            beforeStop: function (event, ui) {
                if(removeItem == true){
                    ui.item.remove();
                }
            }
        });


        $('#btn-create-form-basic').click(function(){

            ajax_submit_form('form-form-basic', '<?=ajax_url() . 'cms/form_ajax/create';?>', function(e){
                window.location.hash = '<?=ajax_url();?>form/edit/' + e;
            });
        })
        $('#btn-update-banner-basic').click(function(){

            ajax_submit_form('form-banner-basic', '<?=ajax_url() . 'cms/banner_ajax/update/basic';?>', function(e){
                $('#msg-banner').find('span').html('The basic info of banner has been updated successfully!');
                $('#msg-banner').removeClass('hide');
                 // scroll up
                $("html, body").animate({
                    scrollTop: 0
                }, "fast");
                setTimeout(function(){
                    $('#msg-banner').addClass('hide');
                }, 2000);
            });
        })

        <? if(isset($banner)) { ?>
            load_banner_images(<?=$banner['banner_id'];?>);
        <? } ?>

    };


    // load bootstrap-progress bar script
    loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/superbox/superbox.min.js", pagefunction);

function add_banner_images(banner_id) {
    var upload_ids = $('#banner_images_upload_ids').html();
    $.ajax({
        type: "POST",
        url: "<?=ajax_url();?>cms/banner_ajax/add_images",
        data: {banner_id: banner_id, upload_ids: upload_ids},
        success: function(html) {
            if (html) {
                $('#msg-error').find('span').html(html);
                $('#msg-error').removeClass('hide');
            } else {
                load_banner_images(banner_id);
            }
        }
    })
}
function load_banner_images(banner_id) {
    $.ajax({
        type: "POST",
        url: "<?=ajax_url();?>cms/banner_ajax/load_images",
        data: {banner_id: banner_id},
        success: function(html) {
            $('#banner_images').html(html);
        }
    })
}
function load_fields() {
    preloading($('#build'));
    $.ajax({
        type: "POST",
        data: {form_id: <?=$form['form_id'];?>},
        url: "<?=ajax_url();?>cms/form_ajax/load_fields",
        success: function(html) {
            loaded($('#build'), html);
        }
    })
}
function edit_field(field_id) {
    $('.popover').hide();
    $.ajax({
        type: "POST",
        url: "<?=ajax_url();?>cms/form_ajax/load_field_edit_form",
        data: {field_id: field_id},
        success: function(html) {
            $('#popover-field').html(html);
            var p = $('#field_' + field_id).position();
            $('#popover-field').css('top', (p.top - 110) + 'px');
            $('#popover-field').show();
        }
    })
}
function delete_field(field_id) {
    if (confirm('Are you sure you want to delete this field?')) {
         $.ajax({
             type: "POST",
             url: "<?=ajax_url();?>cms/form_ajax/delete_field",
             data: {field_id: field_id},
             success: function(html) {
                if (html == 'true') {
                    $('#field_' + field_id).remove();
                } else {
                    alert(html);
                }
             }
         })
    }
}
</script>
