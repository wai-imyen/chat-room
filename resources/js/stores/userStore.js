import { defineStore } from "pinia";
import { ref } from "vue"

export const useUserStore = defineStore('user', () => {
    const userInfo = ref({
        id: 0,
        name: "使用者",
    });

    const updateUserInfo = (data) => {
        userInfo.value = {
			...userInfo.value,
			...data,
		};
	};
    return { userInfo, updateUserInfo }
})