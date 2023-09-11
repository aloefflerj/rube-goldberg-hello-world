export default function ReactComponent(
    { children, title }: { children: JSX.Element | JSX.Element[], title: String }
) {
    return (
        <>
            <div className='react-box' style={{
                backgroundColor: '#61DAFB',
                width: '100%',
                height: '100%'
            }}>
                <div className='header' style={{
                    display: 'flex',
                    justifyContent: 'center',
                    alignItems: 'center',
                    height: '10%',
                    padding: '0',
                    margin: '0',
                    backgroundColor: '#51afe6',
                }}>
                    <h2 style={{
                        padding: '0',
                        margin: '0',
                        color: '#2d6ba5',
                    }}>{title}</h2>
                </div>
                {children}
            </div>
        </>
    );
}