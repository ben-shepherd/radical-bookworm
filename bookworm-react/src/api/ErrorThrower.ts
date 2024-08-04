import { enqueueSnackbar } from "notistack";
import { ApiResponse } from "./Api";

export type ErrorThrowerOptions = {
    showError?: boolean;
}

const ErrorThrower = <Response>(response: ApiResponse<Response>, { showError = true }: ErrorThrowerOptions = {}): ApiResponse<Response> => {
    if (!response.ok && showError) {
        console.error(response)
        enqueueSnackbar({ message: response.json.message, variant: 'error' })
    }

    return response
}

export default ErrorThrower