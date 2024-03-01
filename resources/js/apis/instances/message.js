import { apiRequest } from '../index'

// 取得所有訊息
export const apiGetMessages = () => apiRequest.get('messages');

// 新增訊息
export const apiCreateMessage = (request) => apiRequest.post('messages', request);