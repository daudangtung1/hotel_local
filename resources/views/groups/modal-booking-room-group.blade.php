<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" class="booking-modalLabel">{{__('Group')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        @if(!empty($group) && $action == 'edit')
        <form action="{{route('groups.update', ['group' => $group ])}}" method="POST">
            {{method_field('PUT')}}
            @csrf
            <div class="modal-body row">
                <div class="col-md-6">
                    <h5>{{__('Group_information')}}</h5>
                    <div class="row mt-3" id="form-create-group">
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <input type="hidden" name="customer_id" value="{{$group->customer_id}}">
                        <div class="col-md-6 mb-3 position-relative">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm validate" id="group_name"
                                   name="group_name" required
                                   value="<?= !empty($group) ? $group->name : '' ?>"
                                   placeholder="{{__('Group_name')}}">
                            <div class="col-md-12 mb-3" id="list-item-group"></div>
                            <input type="hidden" id="group_id" value="<?= !empty($group) ? $group->id : '' ?>" />
                        </div>
                        <div class="col-md-12 mb-3">
                    <textarea
                        name="note" class="form-control form-control-sm form-control form-control-sm note" cols="30" rows="2" id="note"
                        placeholder="{{__('Note')}}"><?= !empty($group) ? $group->note : '' ?></textarea>
                        </div>
                    </div>
                    <h5>{{__('Booking_user_information')}}</h5>
                    <div class="row mt-3 form-user" id="form-booking-group">
                        <div class="col-md-6 mb-3 position-relative">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm validate" id="customer_name"
                                   name="customer_name" required
                                   value="<?= !empty($group) ? $group->customer_name : '' ?>"
                                   placeholder="{{__('Customer_name')}}">
                            <div class="col-md-12 mb-3" id="list-item-customer"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm validate" id="customer_id_card"
                                   value="<?= !empty($group) ? $group->id_card : '' ?>"
                                   name="customer_id_card" required
                                   placeholder="{{__('ID_card_2')}}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm validate" id="customer_phone"
                                   value="<?= !empty($group) ? $group->customer_phone : '' ?>"
                                   name="customer_phone" required
                                   placeholder="{{__('Phone_f')}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" autocomplete="off"  class="form-control form-control-sm form-control-sm validate" id="customer_address"
                                   value="<?= !empty($group) ? $group->address : '' ?>"
                                   name="customer_address" required placeholder="{{__('Address')}}">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label fw-bold">{{__('Time_start')}}:</label>
                                    <div class="form-group">
                                        <div class="input-group date">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                            <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                        </span>
                                            <input type="text" autocomplete="off"  id="start_date" name="start_date"
                                                   class="form-control form-control-sm form-control-sm datetime-picker validate-date " readonly
                                                   value="<?= !empty($group) ? $group->start_date : \Carbon\Carbon::now() ?>">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-md-6 "
                                    id="box-end-date">
                                    <label for="end_date" class="form-label fw-bold">{{__('Time_end')}}:</label>
                                    <div class="input-group date">
                                    <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                            <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                        </span>
                                        <input type="text" autocomplete="off"  id="end_date" name="end_date"
                                               class="form-control form-control-sm form-control-sm datetime-picker validate-date " readonly
                                               value="<?= !empty($group) ? $group->end_date : \Carbon\Carbon::now() ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>{{__('Room_list')}}</h5>
                    <div class="div-scroll max-height-300 mb-3" id="list-booking-room">
                        @include('room.list-booking-room')
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(!empty($action) && $action == 'edit')
                    <button class="btn btn-sm btn-danger btn-cancel-booking-group">{{__('Cancel_room')}}</button>
                    <button class="btn btn-sm btn-success btn-update-booking-group">{{__('Update_room')}}</button>
                @else
                    <button class="btn btn-sm btn-primary btn-booking-group">{{__('Booking_room')}}</button>
                @endif
            </div>
        </form>
        @else
        <div class="modal-body row">
            <div class="col-md-6">
                <h5>{{__('Group_information')}}</h5>
                <div class="row mt-3" id="form-create-group">
                    <div class="col-md-6 mb-3 position-relative">
                        <input type="text" autocomplete="off"  class="form-control  form-control-sm validate" id="group_name"
                               name="group_name" required
                               value="<?= !empty($group) ? $group->name : '' ?>"
                               placeholder="{{__('Group_name')}}">
                        <div class="col-md-12 mb-3 list-ajax" id="list-item-group"></div>
                        <input type="hidden" id="group_id" value="<?= !empty($group) ? $group->id : '' ?>" />
                    </div>
                    <div class="col-md-12 mb-3">
                <textarea
                    name="note" class="form-control form-control-sm note" cols="30" rows="2" id="note"
                    placeholder="{{__('Note')}}"><?= !empty($group) ? $group->note : '' ?></textarea>
                    </div>
                </div>
                <h5>{{__('Booking_user_information')}}</h5>
                <div class="row mt-3 form-user" id="form-booking-group">
                    <div class="col-md-6 mb-3 position-relative">
                        <input type="text" autocomplete="off"  class="form-control  form-control-sm validate" id="customer_name"
                               name="customer_name" required
                               value="<?= !empty($group) ? $group->customer_name : '' ?>"
                               placeholder="{{__('Customer_name')}}">
                        <div class="col-md-12 mb-3" id="list-item-customer"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" autocomplete="off"  class="form-control  form-control-sm validate" id="customer_id_card"
                               value="<?= !empty($group) ? $group->id_card : '' ?>"
                               name="customer_id_card" required
                               placeholder="{{__('ID_card_2')}}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="text" autocomplete="off"  class="form-control  form-control-sm validate" id="customer_phone"
                               value="<?= !empty($group) ? $group->customer_phone : '' ?>"
                               name="customer_phone" required
                               placeholder="{{__('Phone_f')}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" autocomplete="off"  class="form-control  form-control-sm validate" id="customer_address"
                               value="<?= !empty($group) ? $group->address : '' ?>"
                               name="customer_address" required placeholder="{{__('Address')}}">
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label fw-bold">{{__('Time_start')}}:</label>
                                <div class="form-group">
                                    <div class="input-group date">
                                    <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                            <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                        </span>
                                        <input type="text" autocomplete="off"  id="start_date" name="start_date"
                                               class="form-control  form-control-sm datetime-picker validate-date " readonly
                                               value="<?= !empty($group) ? $group->start_date : \Carbon\Carbon::now() ?>">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-md-6 "
                                id="box-end-date">
                                <label for="end_date" class="form-label fw-bold">{{__('Time_end')}}:</label>
                                <div class="input-group date">
                                    <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                                            <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                        </span>
                                    <input type="text" autocomplete="off"  id="end_date" name="end_date"
                                           class="form-control  form-control-sm datetime-picker validate-date " readonly
                                           value="<?= !empty($group) ? $group->end_date : \Carbon\Carbon::now() ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5>{{__('Room_list')}}</h5>
                <div class="div-scroll max-height-300 mb-3" id="list-booking-room">
                    @include('room.list-booking-room')
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if(!empty($action) && $action == 'edit')
                <button class="btn btn-sm btn-danger btn-cancel-booking-group">{{__('Cancel_room')}}</button>
                <button class="btn btn-sm btn-success btn-update-booking-group">{{__('Update_room')}}</button>
            @else
                @can('Quản lý khách đoàn-create')
                    <button class="btn btn-sm btn-primary btn-booking-group">{{__('Booking_room')}}</button>
                @endcan
            @endif
        </div>
        @endif;

    </div>
</div>
<script>
    $(document).ready(function(){
        var dateTime = $('.datetime-picker');
        if (dateTime) {
            dateTime.datetimepicker({
                todayHighlight: true,
                format: 'Y-m-d H:i',
                startDate: new Date()
            });
        }
    });
</script>