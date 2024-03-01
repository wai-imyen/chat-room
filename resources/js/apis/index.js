export const apiRequest = axios.create({
    baseUrl: '/',
    headers: {
		"Content-Type": "application/json",
		Accept: "application/json",
	},
});