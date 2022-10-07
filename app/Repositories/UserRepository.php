<?php

namespace App\Repositories;

use App\Helpers\FileHelper;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\SMSHelper;
use App\Models\Country;
use App\Models\Rate;
use App\Models\UserAddress;
use App\Models\UserNotification;
use Termwind\Components\Dd;

class UserRepository
{
    use CrudTrait, ResponseTraits, MainTrait;
    /**
     * @var User
     */
    protected $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * Get all users with type.
     *
     * @return User $user
     */
    public function getWhereType($type)
    {
        return $this->indexWhitConditionTrait($this->model, ['type' => $type]);
    }
    /**
     * Get user by id
     *
     * @param $id
     * @return mixed
     */

    public function showUser($id)
    {
        return $this->showTrait($this->model, $id);
    }
    /**
     * Get user by id
     *
     * @param $id
     * @return mixed
     */
    public function showUserWithRelation($id, $relation)
    {
        return $this->showWithRelationTrait($this->model, $id, $relation);
    }

    public function storeUser($request){
        $data = $request->except('_method' , '_token' , 'image' , 'password' ,'password_confirmation' , 'driving_license' , 'car_license' , 'id_image');

        if($request->type != 'admin'){
            $country = Country::where('id' ,$request->country_id)->select('code')->first();
            $data['phone'] = $country->code.$request->phone;
        }
        $data['password'] = bcrypt($request->password);
        if($request->type == 'admin'){
            $data['verify_phone'] = 1;
            $data['verify_email'] = 1;
        }
        if($request->hasFile('image')){
            if($request->type == 'admin'){
                $data['verify_phone'] = 1;
                $data['verify_email'] = 1;
                $image_path = FileHelper::upload_file('admins' , $request->image);
            }else{
                $image_path = FileHelper::upload_file('clients' , $request->image);
            }
            $data['image'] = $image_path;
        }

        if($request->hasFile('driving_license')){
            $driving_license = FileHelper::upload_file('clients' , $request->driving_license);
            $data['driving_license'] = $driving_license;
        }

        if($request->hasFile('car_license')){
            $car_license = FileHelper::upload_file('clients' , $request->car_license);
            $data['car_license'] = $car_license;
        }

        if($request->hasFile('id_image')){
            $id_image = FileHelper::upload_file('clients' , $request->id_image);
            $data['id_image'] = $id_image;
        }
        return $this->storeTrait($this->model ,$data);
    }

    public function updateUser($id, $request){
        $data = $request->except('_method' , '_token' , 'image' , 'driving_license' , 'car_license' , 'id_image');
        if($request->type != 'admin'){
            $country = Country::where('id' ,$request->country_id)->select('code')->first();
            $data['phone'] = $country->code.$request->phone;
        }
        $user = $this->model->where('id',$id)->first();
        if($request->hasFile('image')){
            if($request->type == 'admin' || $request->type == 'super_admin'){
                $image_path = FileHelper::update_file('admins' , $request->image ,$user->image );
            }else{
                $image_path = FileHelper::update_file('clients' , $request->image ,$user->image);
            }
            $data['image'] = $image_path;
        }

        if($request->type == 'super_admin'){
            unset($data['type']);
        }

        if($request->hasFile('driving_license')){
            $driving_license = FileHelper::update_file('clients' , $request->driving_license,$user->driving_license);
            $data['driving_license'] = $driving_license;
        }

        if($request->hasFile('car_license')){
            $car_license = FileHelper::update_file('clients' , $request->car_license , $user->car_license);
            $data['car_license'] = $car_license;
        }

        if($request->hasFile('id_image')){
            $id_image = FileHelper::update_file('clients' , $request->id_image , $user->id_image);
            $data['id_image'] = $id_image;
        }
        return $this->updateTrait($this->model, $id, $data);
    }

    /**
     * Update User
     *
     * @param $data
     * @return User
     */
    public function destroy($id)
    {
        $user = $this->model->where('id',$id)->first();
        dd($user);
        if($user->image != null){
            FileHelper::delete_picture($user->image);
        }
        return $this->destroyTrait($this->model, $id);
    }

    /**
     * Forgot Password Email.
     * Generate random password and send it with message
     * @param array $data
     * @return String
     */

    public function generatePasswordCode($phone , $text = null)
    {
        $user = $this->model->where('phone', $phone)->first();
        if ($user != null) {
            $user->code = rand(100000, 999999);
            $user->save();
            $message = new SMSHelper();
            if($text != null){
                $message->sendMessage($text.' '.$user->code , $user->phone);
            }else{
                $message->sendMessage(trans('admin.use_code_change_password').' '.$user->code , $user->phone);
            }
            return $user->code;
        } else {
            return false;
        }
    }

    public function generatePhoneCode($phone , $text = null)
    {
        $user = $this->model->where('id', auth()->user()->id)->first();
        if ($user != null) {
            $user->code = rand(100000, 999999);
            $user->save();
            $message = new SMSHelper();
            if($text != null){
                $message->sendMessage($text.' '.$user->code , $user->phone);
            }else{
                $message->sendMessage(trans('admin.use_code_change_phone').' '.$user->code , $user->phone);
            }
            return $user->code;
        } else {
            return false;
        }
    }

    /**
     * Reset Password
     *
     * @param array $data
     * @return String
     */

    public function resetPassword($request)
    {
        $country = Country::where('id' , $request->country_id)->select('code')->first();
        $phone = $country->code.$request->phone;
        $user = $this->model->where('phone', $phone)->where('code' , $request->code)->first();
        if($user != null){
            $user->password = bcrypt($request->password);
            $user->code='';
            $user->save();
            return $user;
        }else{
            return false;
        }
    }
    /**
     * Verfiy Account.
     *
     * @param array $data
     * @return True
     */

    public function verifyAccount($request)
    {
        $country = Country::where('id' ,$request->country_id)->select('code')->first();
        $phone = $country->code.$request->phone;
        $user = User::where('phone', $phone)
            ->where('code', $request->code)
            ->first();
        if ($user != null) {
            $user->verify_phone= 1;
            $user->code='';
            $user->save();
            return true;
        } else {
            return false;
        }
    }
    /**
     * Authenticated Users.
     */
    /**
     * Change password for user by calling ChangePasswordTrait
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function changePassword($id, $old_password, $new_password)
    {

        return $this->ChangePasswordTrait($this->model, $id, $old_password, $new_password);
    }
    /**
     * Update Profile
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */

    public function storeFinance($user, $data)
    {
        if (array_key_exists('image', $data)) {
            $image_path = FileHelper::upload_file('/users/' . $user['id'] . '/financialTransactions/', $data['image']);
            $data['image'] = $image_path;
        }
        $user->ProviderFinance()->create($data);
        return $user;
    }

    /**
     * update user type to provider .
     *
     * @param array $data
     * @return String
     */

    public function updateToProvider($request)
    {
        $user = $this->model->where('id' , auth()->user()->id)->first();
        $addressData = $request->except('id_image' , 'driving_license' , 'car_license');
        $addressData['user_id'] = auth()->user()->id;
        $addressData['main_address'] = 1;
        $userData = [];

        $userData['request_to_be_provider'] = 1;

        if($request->hasFile('id_image')){
            $image_path = FileHelper::update_file('clients' , $request->id_image ,$user->id_image);
            $userData['id_image'] = $image_path;
        }

        if($request->hasFile('driving_license')){
            $image_path = FileHelper::update_file('clients' , $request->driving_license ,$user->driving_license);
            $userData['driving_license'] = $image_path;
        }

        if($request->hasFile('car_license')){
            $image_path = FileHelper::update_file('clients' , $request->car_license ,$user->car_license);
            $userData['car_license'] = $image_path;
        }

        $this->updateTrait($this->model, auth()->user()->id, $userData);
        UserAddress::create($addressData);
        return true;
    }

    /**
     * Stop the service temporarily
     *
     * @param array $data
     * @return String
     */

    public function stopService($user, $request)
    {
        $user->stop_service = $request->stop_service;
        $user->save();
        return $user->stop_service;
    }
    /**
     *  change activation status.
     *
     * @param array $data
     * @return String
     */

    public function activationStatus($user, $request)
    {
        $user->active_status = $request->active_status;
        $user->save();
        return $user->active_status;
    }

    /**
     * Verfiy New Phone.
     *
     * @param array $data
     * @return True
     */

    public function verifyNewPhone($request)
    {
        $country = Country::where('id' ,$request->country_id)->select('code')->first();
        $phone = $country->code.$request->phone;
        return $this->model->where('phone', $phone)
                            ->where('code', $request->code)
                            ->first();
    }

    public function verifyCode($code)
    {
        return $this->model->where('id', auth()->user()->id)->where('code', $code)->first();

    }

    public function updateUserData($key , $value , $code = null){
        if($code != null){
            return  $this->model
                        ->where('id' , auth()->user()->id)
                        ->where('code' , $code)
                        ->update([$key=>$value , 'code'=>'']);
        }else{
            return  $this->model->where('id' , auth()->user()->id)->update([$key=>$value]);
        }
    }

    public function userAddresses($id){
        return UserAddress::where('user_id' , $id)->with(['city.country' , 'tag'])->orderBy('id' , 'DESC')->get();
    }

    public function showAddress($id){
        return UserAddress::where('id' , $id)->with(['city.country' , 'tag'])->first();
    }

    public function deleteAddress($id){
        return UserAddress::where('id' , $id)->delete();
    }

    public function updateAddress($request,$id){
        $data = $request->all();
        return UserAddress::where('id' , $id)->update($data);
    }

    public function getUserNotifications(){
        return UserNotification::with('notification')->where('user_id', auth()->user()->id)->orderBy('id' , 'DESC')->get();
    }

    public function markNotificationAsRead($readRequest){
        $userNotification = UserNotification::where('id', $readRequest->id)->where('user_id',auth()->user()->id)->first();
        if($userNotification){
            $userNotification->is_read = 1;
            $userNotification->save();
        }
        return $userNotification;
    }

    public function markAllNotificationAsRead(){
        return UserNotification::where('user_id',auth()->user()->id)->update(['is_read' => 1]);
    }

    public function openReceiveOrders(){
        $user = $this->model->where('id' , auth()->user()->id)->first();
        $user->receive_orders_status = 1;
        $user->save();
        return true;
    }

    public function closeReceiveOrders(){
        $user = $this->model->where('id' , auth()->user()->id)->first();
        $user->receive_orders_status = 0;
        $user->save();
        return true;
    }

    public function rateUser($request){
        $data = $request->all();
        $data['reviewer_id'] = auth()->user()->id;
        $rate = Rate::create($data);
        $avgRate = Rate::where('user_id' , $request->user_id)->avg('rate');
        $this->model->where('id' , $request->user_id)->update(['rate'=>$avgRate]);
        return $rate;
    }

    public function userRates(){
        return Rate::where('user_id' ,auth()->user()->id)->with('reviewer:id,name,image')->orderBy('id' , 'DESC')->get();
    }
}
