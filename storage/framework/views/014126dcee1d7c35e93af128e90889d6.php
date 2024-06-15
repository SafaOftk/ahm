<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Balance Sheet')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Balance Sheet')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#filter").click(function() {
                $("#show_filter").toggle();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            callback();

            function callback() {
                var start_date = $(".startDate").val();
                var end_date = $(".endDate").val();

                $('.start_date').val(start_date);
                $('.end_date').val(end_date);

            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" onclick="saveAsPDF()" class="btn btn-sm btn-primary me-1" data-bs-toggle="tooltip"
            title="<?php echo e(__('Print')); ?>" data-original-title="<?php echo e(__('Print')); ?>"><i class="ti ti-printer"></i></a>
    </div>

    <div class="float-end me-2">
        <?php echo e(Form::open(['route' => ['balance.sheet.export']])); ?>

        <input type="hidden" name="start_date" class="start_date">
        <input type="hidden" name="end_date" class="end_date">
        <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>"
            data-original-title="<?php echo e(__('Export')); ?>"><i class="ti ti-file-export"></i></button>
        <?php echo e(Form::close()); ?>

    </div>

    <div class="float-end me-2" id="filter">
        <button id="filter" class="btn btn-sm btn-primary"><i class="ti ti-filter"></i></button>
    </div>

    <div class="float-end me-2">
        <a href="<?php echo e(route('report.balance.sheet', 'vertical')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            title="<?php echo e(__('Vertical View')); ?>" data-original-title="<?php echo e(__('Vertical View')); ?>"><i
                class="ti ti-separator-horizontal"></i></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mt-2" id="multiCollapseExample1">
                    <div class="card" id="show_filter" style="display:none;">
                        <div class="card-body">
                            <?php echo e(Form::open(['route' => ['report.balance.sheet'], 'method' => 'GET', 'id' => 'report_bill_summary'])); ?>

                            <div class="col-xl-12">

                                <div class="row justify-content-between">
                                    <div class="col-xl-3 mt-4">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons"
                                            aria-label="Basic radio toggle button group">
                                            <label class="btn btn-primary month-label">
                                                <a href="<?php echo e(route('report.balance.sheet', ['horizontal', 'collapse'])); ?>"
                                                    class="text-white" id="collapse"> <?php echo e(__('Collapse')); ?> </a>
                                            </label>
                                            <label class="btn btn-primary year-label active">
                                                <a href="<?php echo e(route('report.balance.sheet', ['horizontal', 'expand'])); ?>"
                                                    class="text-white"> <?php echo e(__('Expand')); ?> </a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-9">
                                        <div class="row justify-content-end align-items-center">
                                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                                <div class="btn-box">
                                                    <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::date('start_date', $filter['startDateRange'], ['class' => 'startDate form-control'])); ?>

                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                                <div class="btn-box">
                                                    <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::date('end_date', $filter['endDateRange'], ['class' => 'endDate form-control'])); ?>

                                                </div>
                                            </div>
                                            <input type="hidden" name="view" value="horizontal">

                                            <div class="col-auto mt-4">
                                                <a href="#" class="btn btn-sm btn-primary"
                                                    onclick="document.getElementById('report_bill_summary').submit(); return false;"
                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"
                                                    data-original-title="<?php echo e(__('apply')); ?>">
                                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                                </a>

                                                <a href="<?php echo e(route('report.balance.sheet', 'horizontal')); ?>"
                                                    class="btn btn-sm btn-danger " data-bs-toggle="tooltip"
                                                    title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                                    <span class="btn-inner--icon"><i
                                                            class="ti ti-trash-off text-white-off "></i></span>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $authUser = \Auth::user()->creatorId();
            $user = App\Models\User::find($authUser);
        ?>

        <div class="row justify-content-center" id="printableArea">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body <?php echo e($collapseview == 'expand' ? 'collapse-view' : ''); ?>">
                        <div class="account-main-title mb-5">
                            <h5><?php echo e('Balance Sheet of ' . $user->name . ' as of ' . $filter['startDateRange'] . ' to ' . $filter['endDateRange']); ?>

                                </h4>
                        </div>

                        <?php
                            $totalAmount = 0;
                        ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="aacount-title d-flex align-items-center justify-content-between border py-2">
                                    <h5 class="mb-0 ms-3"><?php echo e(__('Liabilities & Equity')); ?></h5>
                                </div>
                                <div class="border-start border-end">
                                    <?php $__currentLoopData = $totalAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($accounts != [] && $type != 'Assets'): ?>
                                            <div class="account-main-inner py-2">
                                                <p class="fw-bold ps-2 mb-2"><?php echo e($type); ?></p>
                                                <?php
                                                    $total = 0;
                                                ?>
                                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="border-bottom py-2">
                                                        <p class="fw-bold ps-4 mb-2">
                                                            <?php echo e($account['subType'] == true ? $account['subType'] : ''); ?>

                                                        </p>
                                                        <?php $__currentLoopData = $account['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $records): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($collapseview == 'collapse'): ?>
                                                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($record['account'] == 'parentTotal'): ?>
                                                                <div
                                                                    class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                                    <div class="mb-2 account-arrow">
                                                                        <div class="">
                                                                            <a
                                                                                href="<?php echo e(route('report.balance.sheet', ['horizontal', 'expand'])); ?>"><i
                                                                                    class="ti ti-chevron-down account-icon"></i></a>
                                                                        </div>
                                                                        <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                            class="text-primary"><?php echo e(str_replace('Total ', '', $record['account_name'])); ?></a>
                                                                    </div>
                                                                    <p class="mb-2 ms-3 text-center">
                                                                        <?php echo e($record['account_code']); ?></p>
                                                                    <p
                                                                        class="text-primary mb-2 float-end text-end me-3">
                                                                        <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                    </p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if(($key < count($account['account']) - 1 && $record['account'] == '') || $record['account'] != 'subAccount'): ?>
                                                                <?php if(
                                                                    (!preg_match('/\btotal\b/i', $record['account_name']) && $record['account'] == '') ||
                                                                        $record['account'] == 'subAccount'): ?>
                                                                    <div
                                                                        class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                                        <p class="mb-2 ms-3"><a
                                                                                href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                                class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                                        </p>
                                                                        <p class="mb-2 text-center">
                                                                            <?php echo e($record['account_code']); ?></p>
                                                                        <p
                                                                            class="text-primary mb-2 float-end text-end me-3">
                                                                            <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                        </p>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($record['account'] == 'parent' || $record['account'] == 'parentTotal'): ?>
                                                                <div
                                                                    class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                                    <?php if($record['account'] == 'parent'): ?>
                                                                        <div class="mb-2 account-arrow">
                                                                            <div class="">
                                                                                <a
                                                                                    href="<?php echo e(route('report.balance.sheet', ['horizontal', 'collapse'])); ?>"><i
                                                                                        class="ti ti-chevron-down account-icon"></i></a>
                                                                            </div>
                                                                            <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                                class="<?php echo e($record['account'] == 'parent' ? 'text-primary' : 'text-dark'); ?> fw-bold"><?php echo e($record['account_name']); ?></a>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <p class="mb-2"><a href="#"
                                                                                class="text-dark fw-bold"><?php echo e($record['account_name']); ?></a>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                    <p class="mb-2 ms-3 text-center">
                                                                        <?php echo e($record['account_code']); ?></p>
                                                                    <p
                                                                        class="text-dark fw-bold mb-2 float-end text-end me-3">
                                                                        <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                    </p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if(($key < count($account['account']) - 1 && $record['account'] == '') || $record['account'] == 'subAccount'): ?>
                                                                <?php if(
                                                                    (!preg_match('/\btotal\b/i', $record['account_name']) && $record['account'] == '') ||
                                                                        $record['account'] == 'subAccount'): ?>
                                                                    <div
                                                                        class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                                        <p class="mb-2 ms-3"><a
                                                                                href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                                class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                                        </p>
                                                                        <p class="mb-2 text-center">
                                                                            <?php echo e($record['account_code']); ?></p>
                                                                        <p
                                                                            class="text-primary mb-2 float-end text-end me-3">
                                                                            <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                        </p>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <div
                                                            class="account-inner d-flex align-items-center justify-content-between ps-4">
                                                            <p class="fw-bold mb-2">
                                                                <?php echo e($record['account_name'] ? $record['account_name'] : ''); ?>

                                                            </p>
                                                            <p class="fw-bold mb-2 text-end me-3">
                                                                <?php echo e($record['netAmount'] ? \Auth::user()->priceFormat($record['netAmount']) : \Auth::user()->priceFormat(0)); ?>

                                                            </p>
                                                        </div>
                                                    </div>

                                                    <?php
                                                        $total += $record['netAmount'] ? $record['netAmount'] : 0;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <div
                                                    class="aacount-title d-flex align-items-center justify-content-between border-top border-bottom py-2 px-2 pe-0">
                                                    <h6 class="fw-bold mb-0"><?php echo e('Total for ' . $type); ?></h6>
                                                    <h6 class="fw-bold mb-0 text-end me-3">
                                                        <?php echo e(\Auth::user()->priceFormat($total)); ?></h6>
                                                </div>
                                                <?php
                                                    if ($type != 'Assets') {
                                                        $totalAmount += $total;
                                                    }
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($totalAmount != 0): ?>
                                        <div
                                            class="d-flex align-items-center justify-content-between border-bottom py-2 px-0">
                                            <h6 class="fw-bold mb-0 ms-2"><?php echo e('Total for Liabilities & Equity'); ?></h6>
                                            <h6 class="fw-bold mb-0 text-end me-3">
                                                <?php echo e(\Auth::user()->priceFormat($totalAmount)); ?></h6>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>

                            <?php
                                $total = 0;
                                $totalAmounts = 0;
                            ?>

                            <div class="col-md-6">
                                <div class="aacount-title d-flex align-items-center justify-content-between border py-2">
                                    <h5 class="mb-0 ms-3"><?php echo e(__('Assets')); ?></h5>
                                </div>
                                <div class="border-start border-end">
                                    <?php $__currentLoopData = $totalAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($accounts != [] && $type == 'Assets'): ?>
                                            <div class="account-main-inner py-2">
                                                <?php if($type == 'Liabilities'): ?>
                                                    <p class="fw-bold mb-3"> <?php echo e(__('Liabilities & Equity')); ?></p>
                                                <?php endif; ?>
                                                <p class="fw-bold ps-2 mb-2"><?php echo e($type); ?></p>
                                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="border-bottom py-2">
                                                        <p class="fw-bold ps-4 mb-2">
                                                            <?php echo e($account['subType'] == true ? $account['subType'] : ''); ?>

                                                        </p>
                                                        <?php $__currentLoopData = $account['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $records): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($collapseview == 'collapse'): ?>
                                                                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($record['account'] == 'parentTotal'): ?>
                                                                        <div
                                                                            class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                                            <div class="mb-2 account-arrow">
                                                                                <div class="">
                                                                                    <a
                                                                                        href="<?php echo e(route('report.balance.sheet', ['horizontal', 'expand'])); ?>"><i
                                                                                            class="ti ti-chevron-down account-icon"></i></a>
                                                                                </div>
                                                                                <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                                    class="text-primary"><?php echo e(str_replace('Total ', '', $record['account_name'])); ?></a>
                                                                            </div>
                                                                            <p class="mb-2 ms-3 text-center">
                                                                                <?php echo e($record['account_code']); ?></p>
                                                                            <p
                                                                                class="text-primary mb-2 float-end text-end me-3">
                                                                                <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if(($key < count($account['account']) - 1 && $record['account'] == '') || $record['account'] != 'subAccount'): ?>
                                                                        <?php if(
                                                                            (!preg_match('/\btotal\b/i', $record['account_name']) && $record['account'] == '') ||
                                                                                $record['account'] == 'subAccount'): ?>
                                                                            <div
                                                                                class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                                                <p class="mb-2 ms-3"><a
                                                                                        href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                                        class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                                                </p>
                                                                                <p class="mb-2 text-center">
                                                                                    <?php echo e($record['account_code']); ?></p>
                                                                                <p
                                                                                    class="text-primary mb-2 float-end text-end me-3">
                                                                                    <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($record['account'] == 'parent' || $record['account'] == 'parentTotal'): ?>
                                                                        <div
                                                                            class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                                            <?php if($record['account'] == 'parent'): ?>
                                                                                <div class="mb-2 account-arrow">
                                                                                    <div class="">
                                                                                        <a
                                                                                            href="<?php echo e(route('report.balance.sheet', ['horizontal', 'collapse'])); ?>"><i
                                                                                                class="ti ti-chevron-down account-icon"></i></a>
                                                                                    </div>
                                                                                    <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                                        class="<?php echo e($record['account'] == 'parent' ? 'text-primary' : 'text-dark'); ?> fw-bold"><?php echo e($record['account_name']); ?></a>
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <p class="mb-2"><a href="#"
                                                                                        class="text-dark fw-bold"><?php echo e($record['account_name']); ?></a>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                            <p class="mb-2 ms-3 text-center">
                                                                                <?php echo e($record['account_code']); ?></p>
                                                                            <p
                                                                                class="text-dark fw-bold mb-2 float-end text-end me-3">
                                                                                <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if(($key < count($account['account']) - 1 && $record['account'] == '') || $record['account'] == 'subAccount'): ?>
                                                                        <?php if(
                                                                            (!preg_match('/\btotal\b/i', $record['account_name']) && $record['account'] == '') ||
                                                                                $record['account'] == 'subAccount'): ?>
                                                                            <div
                                                                                class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                                                <p class="mb-2 ms-3"><a
                                                                                        href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                                        class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                                                </p>
                                                                                <p class="mb-2 text-center">
                                                                                    <?php echo e($record['account_code']); ?></p>
                                                                                <p
                                                                                    class="text-primary mb-2 float-end text-end me-3">
                                                                                    <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                                </p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between ps-4">
                                                                <p class="fw-bold mb-2">
                                                                    <?php echo e($record['account_name'] ? $record['account_name'] : 0); ?>

                                                                </p>
                                                                <p class="fw-bold mb-2 text-end me-3">
                                                                    <?php echo e($record['netAmount'] ? \Auth::user()->priceFormat($record['netAmount']) : \Auth::user()->priceFormat(0)); ?>

                                                                </p>
                                                            </div>
                                                    </div>

                                                    <?php
                                                        $total += $record['netAmount'] ? $record['netAmount'] : 0;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    if ($type == 'Assets') {
                                                        $totalAmounts += $total;
                                                    }
                                                ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($totalAmounts != 0): ?>
                                        <div
                                            class="d-flex align-items-center justify-content-between border-bottom py-2 px-0">
                                            <h6 class="fw-bold mb-0 ms-2"><?php echo e('Total for Assets'); ?></h6>
                                            <h6 class="fw-bold mb-0 text-end me-3">
                                                <?php echo e(\Auth::user()->priceFormat($totalAmounts)); ?></h6>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\main.local\erpgo\resources\views/report/balance_sheet_horizontal.blade.php ENDPATH**/ ?>