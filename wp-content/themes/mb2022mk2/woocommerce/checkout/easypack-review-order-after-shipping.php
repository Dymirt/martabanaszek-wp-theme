<?php
/**
 * Review Order After Shipping EasyPack
 *
 * @author
 * @package    EasyPack/Templates
 * @version
 */

$parcel_machine_selected = false;
$selected                = '';

?>
<tr class="easypack-parcel-machine">
    <th class="easypack-parcel-machine-label" >
        <?php echo __('Select Parcel Locker', EasyPack::$text_domain); ?>
    </th>
    <td class="easypack-parcel-machine-select">


        <?php
        $cod = isset($_cod) && true === $_cod;

        $countryCode = get_option('easypack_api_country');

        if ('gb' === $countryCode) {
            $countryCode = 'uk';
            $lon         = '51.507351';
            $lat         = '-0.127758';
            $loc         = 'defaultLocation: [51.507351, -0.127758],';
        } else {
            $countryCode = 'pl';
            $lon         = '51.507351';
            $lat         = '-0.127758';
            $loc         = '';
        }
        ?>

        <?php if (defined('DOING_AJAX') && true === DOING_AJAX): ?>

            <?php $randomId = 'id' . rand(1, 9999); ?>
            <a id="popup-btn"></a>
            <button class="button alt"
                    name="geowidget_show_map"
                    id="geowidget_show_map"
                    value="<?php echo __('Select parcel locker', EasyPack::$text_domain); ?>"
                    data-value="<?php echo __('Select parcel locker', EasyPack::$text_domain); ?>">
                <?php echo __('Select parcel locker', EasyPack::$text_domain); ?></button>

            <script type="text/javascript">
                var initiated = false;

                window.easyPackAsyncInit = (function () {
                    easyPack.init({});
                });
                jQuery('#geowidget_show_map').click(function (e) {
                    e.preventDefault();
                    easyPack.init({
                        apiEndpoint: 'https://api-<?php echo $countryCode?>-points.easypack24.net/v1',
                        defaultLocale: '<?php echo $countryCode?>',
                        closeTooltip: false,
                        points: {
                            <?php if ('PL' === EasyPack_API()->api_country()):?>
                            types: ['parcel_locker']
                            <?php else:?>
                            types: ['parcel_locker']
                            <?php endif?>
                        },
                        map: {
                            <?php echo $loc?>
                            useGeolocation: true,
                            initialTypes: ['parcel_locker']
                        }
                    });

                    easyPack.modalMap(function (point, modal) {
                        modal.closeModal();
                        var parcelMachineAddressDesc = getAddressByPoint(point);
                        jQuery('#parcel_machine_id').val(point.name);
                        jQuery('#parcel_machine_desc').val(parcelMachineAddressDesc);
                        //jQuery('#easypack-map').addClass('hidden');
                        jQuery('#selected-parcel-machine').removeClass('hidden');
                        jQuery('#selected-parcel-machine-id').html(parcelMachineAddressDesc);
                    }, {width: 500, height: 600});


                    setTimeout(function () {
                        jQuery("html, body").animate({scrollTop: jQuery('#widget-modal').offset().top}, 1000);

                    }, 0);

                });


                jQuery(document).ready(function () {

                });

            </script>

            <div id="selected-parcel-machine" class="hidden">
                <div><span class="font-height-600">
                <?php _e('Selected parcel locker', EasyPack::$text_domain); ?>
                </span></div>
                <span class="italic" id="selected-parcel-machine-id"></span>
            </div>
            <input type="hidden" id="parcel_machine_id" name="parcel_machine_id"/>
            <input type="hidden" id="parcel_machine_desc" name="parcel_machine_desc"/>

        <?php else: ?>

        <?php endif ?>


    </td>
</tr>
