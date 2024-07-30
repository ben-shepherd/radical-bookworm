type Props = {
    label: string;
    value?: string;
    onChange?: (...args: any[]) => any;
    EditComponent?: React.ReactNode;
}

const StylizedTextField = ({ label, EditComponent, value, onChange }: Props) => {

    const handleChange = (value: string) => {
        if(typeof onChange === 'function') {
            onChange(value)
        }
    }

    const renderEditComponent = (): React.ReactNode => {
        if(EditComponent) {
            return EditComponent;
        }

        return (
            <input type='text' value={value} onChange={(e) => handleChange(e.target.value)} />
        )
    };

    return (
        <div className="StylizedTextField">
            <div className="Label">
                <p>{label}</p>
            </div>
            <div className="Component">
                {renderEditComponent()}          
            </div>
        </div>
    )
}

export default StylizedTextField