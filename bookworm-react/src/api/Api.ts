export type SuccessfulResponse<Response> = {
    ok: true;
    code: 200 | 201 | 202;
    json: Response
}
export type FailedResponse = {
    ok: false;
    code: number;
    json: {
        message: string
    }
}
export type ApiResponse<Response> = SuccessfulResponse<Response> | FailedResponse

const Api = async <Response>(url: string, request: RequestInit): Promise<ApiResponse<Response>> => {

    try {
        url = url.length && !url.startsWith('/') ? `/${url}` : url;

        const path = `${process.env.REACT_APP_API_URL}/api${url}`;

        const headers = {
            ...(request.headers ?? {}),
            "Content-Type": "application/json",
            "Accept": "application/json",
            "Authorization": `Bearer ${process.env.REACT_APP_API_TOKEN}`
        };

        const response = await fetch(path, {...request, headers})

        return {
            ok: response.status === 200 || response.status === 201 || response.status === 202,
            code: response.status,
            json: await response.json()
        } as ApiResponse<Response>
    } catch (error) {
        let errorMessage = error instanceof Error ? error.message : 'Something went wrong.';

        return {
            ok: false,
            code: 500,
            json: {
                message: errorMessage
            }
        }
    }
}

export default Api