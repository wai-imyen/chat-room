import { apiRequest } from '../index'

// 取得登入會員
export const apiGetUserInfo = () => apiRequest.get('user');